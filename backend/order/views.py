from django.shortcuts import render, redirect, get_object_or_404
from django.template.loader import render_to_string
from django.http import JsonResponse
from django.contrib import messages

from .models import Product, CartOrder, CartOrderItem, CustomerInformation
from .forms import BillingInformationForm


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
            customer = CustomerInformation.objects.create(
                first_name = billing_information_form.cleaned_data['first_name'],
                last_name = billing_information_form.cleaned_data['last_name'],
                email_address = billing_information_form.cleaned_data['email_address'],
                phone_number = billing_information_form.cleaned_data['phone_number'],
                address = billing_information_form.cleaned_data['address'],
                additional_information = billing_information_form.cleaned_data.get('additional_information'),
            )

            order = CartOrder.objects.create(
                customer = customer,
                order_status = "pending",
                payment_status = False,
            )

            for product_id, item_data in cart_data.items():
                product = get_object_or_404(Product, pk=product_id)
                quantity = item_data['quantity']
                CartOrderItem.objects.create(
                    order=order,
                    product=product,
                    quantity=quantity,
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
