from django.shortcuts import render, get_object_or_404
from django.template.loader import render_to_string
from django.http import JsonResponse

from product.models import Category, Product


def shop(request):
    categories = Category.objects.all
    products = Product.objects.all

    context = {
        "categories" : categories,
        "products" : products,
    }
    return render(request, 'core/shop.html', context)


def product_details(request, slug):
    product = get_object_or_404(Product, slug=slug)
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
