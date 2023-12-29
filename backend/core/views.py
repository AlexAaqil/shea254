import json
from django.shortcuts import render, redirect, get_object_or_404
from django.template.loader import render_to_string
from django.http import JsonResponse
from django.contrib import messages
from .models import Product, Category, Order
from .forms import BillingInformationForm


def index(request):
    categories = Category.objects.all()[:5]
    products = Product.objects.filter(in_stock=True, featured=True).order_by('-created_at')[:4]

    context = {
        "categories" : categories,
        "products" : products,
    }

    return render(request, 'core/index.html', context)


def about(request):
    return render(request, 'core/about.html')


def contact(request):
    return render(request, 'core/contact.html')


def shop(request):
    categories = Category.objects.all
    products = Product.objects.all

    context = {
        "categories" : categories,
        "products" : products,
    }
    return render(request, 'core/shop.html', context)


def product_details(request, pid):
    product = get_object_or_404(Product, pid=pid)
    product_images = product.product_images.all()
    products = Product.objects.filter(category=product.category).exclude(pid=product.pid).order_by('-created_at')[:5]

    context = {
        "product" : product,
        "product_images" : product_images,
        "products" : products,
    }

    return render(request, 'core/product_details.html', context)


def search(request):
    query = request.GET.get("q")

    categories = Category.objects.all
    products = Product.objects.filter(title__icontains=query).order_by("-created_at")

    context = {
        "categories" : categories,
        "products" : products,
        "query" : query,
    }

    return render(request, 'core/categorised_products.html', context)


def filter_products(request):
    categories = request.GET.getlist("category[]")

    products = Product.objects.filter(product_status="published").order_by("-id").distinct()

    if len(categories) > 0:
        products = products.filter(category__id__in=categories).distinct()

    data = render_to_string("core/async/filtered_products.html", {"products" : products})

    return JsonResponse({"data" : data})


def cart(request):
    cart_total_amount = 0
    if 'cart_data_object' in request.session:
        for product_id, item in request.session['cart_data_object'].items():
            cart_total_amount += int(item['quantity']) * float(item['price'])

        data = request.session['cart_data_object']
        total_cart_items = len(data)

        context = {
            "data" : data,
            "total_cart_items" : total_cart_items,
            "cart_total_amount" : cart_total_amount,
        }

        return render(request, 'core/cart.html', context)

    else:
        messages.warning(request, "Your Cart is Empty")
        return redirect("core:index")


def add_to_cart(request):
    cart_products = {}

    cart_products[str(request.GET['id'])] = {
        'pid' : request.GET['pid'],
        'title' : request.GET['title'],
        'quantity' : request.GET['quantity'],
        'price' : request.GET['price'],
        'image' : request.GET['image'],
    }

    if 'cart_data_object' in request.session:
        if str(request.GET['id']) in request.session['cart_data_object']:
            cart_data = request.session['cart_data_object']
            cart_data[str(request.GET['id'])]['quantity'] = int(cart_products[str(request.GET['id'])]['quantity'])
            cart_data.update(cart_data)
            request.session['cart_data_object'] = cart_data
        else:
            cart_data = request.session['cart_data_object']
            cart_data.update(cart_products)
            request.session['cart_data_object'] = cart_data
    else:
        request.session['cart_data_object'] = cart_products

    return JsonResponse({"data":request.session['cart_data_object'], "total_cart_items":len(request.session['cart_data_object'])})


def update_cart_quantity(request):
    product_id = str(request.GET['id'])
    quantity = request.GET['quantity']

    if 'cart_data_object' in request.session:
        if product_id in request.session['cart_data_object']:
            cart_data = request.session['cart_data_object']
            cart_data[str(request.GET['id'])]['quantity'] = quantity
            request.session['cart_data_object'] = cart_data

    cart_total_amount = 0
    for product_id, item in request.session['cart_data_object'].items():
        cart_total_amount = sum(int(item['quantity']) * float(item['price']) for item in cart_data.values())

    data = request.session['cart_data_object']
    total_cart_items = len(data)

    context = {
        "data": data,
        "total_cart_items": total_cart_items,
        "cart_total_amount": cart_total_amount,
    }
    rendered_html = render_to_string("core/async/cart_list.html", context)

    # Return rendered HTML as JSON response
    return JsonResponse({"data": rendered_html, "total_cart_items": total_cart_items, "cart_total_amount": cart_total_amount})


def delete_from_cart(request):
    product_id = str(request.GET['id'])

    if 'cart_data_object' in request.session:
        if product_id in request.session['cart_data_object']:
            cart_data = request.session['cart_data_object']
            del request.session['cart_data_object'][product_id]
            request.session['cart_data_object'] = cart_data

    cart_total_amount = 0
    for product_id, item in request.session['cart_data_object'].items():
        cart_total_amount = sum(int(item['quantity']) * float(item['price']) for item in cart_data.values())

    data = request.session['cart_data_object']
    total_cart_items = len(data)

    context = {
        "data": data,
        'total_cart_items': total_cart_items,
        'cart_total_amount': cart_total_amount,
    }
    rendered_html = render_to_string("core/async/cart_list.html", context)

    # Return rendered HTML as JSON response
    return JsonResponse({"data": rendered_html, "total_cart_items": total_cart_items})


def checkout(request):
    cart_data = request.session.get('cart_data_object', {})
    total_amount = sum(float(item['price']) * int(item['quantity']) for item in cart_data.values())

    if request.method == 'POST':
        billing_information_form = BillingInformationForm(request.POST)
        if billing_information_form.is_valid():
            first_name = billing_information_form.cleaned_data['first_name']
            last_name = billing_information_form.cleaned_data['last_name']
            email_address = billing_information_form.cleaned_data['email_address']
            phone_number = billing_information_form.cleaned_data['phone_number']
            address = billing_information_form.cleaned_data['address']
            additional_information = billing_information_form.cleaned_data.get('additional_information')

            order = Order.objects.create(
                first_name=first_name,
                last_name=last_name,
                email_address=email_address,
                phone_number=phone_number,
                address=address,
                additional_information=additional_information,
                items=cart_data,
                total_amount=total_amount
            )

            del request.session['cart_data_object']
            return redirect('core:order_confirmation', order_id=order.oid)
    else:
        billing_information_form = BillingInformationForm()

    context = {
        "cart_data" : cart_data,
        "total_amount" : total_amount,
        "form" : billing_information_form,
    }

    return render(request, 'core/checkout.html', context)


def order_confirmation(request, order_id):
    context = {
        "order_id": order_id,
    }
    return render(request, "core/order_confirmation.html", context)
