from django.shortcuts import render, redirect, get_object_or_404
from django.template.loader import render_to_string
from django.http import JsonResponse, HttpResponse
from django.contrib import messages
from .models import Product, Category


def index(request):
    categories = Category.objects.all()[:5]
    products = Product.objects.all().order_by('-created_at')[:4]

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
    products = Product.objects.filter(title__icontains=query).order_by("-date")

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
