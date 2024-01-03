import json
from django.shortcuts import render

from product.models import Category, Product


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
