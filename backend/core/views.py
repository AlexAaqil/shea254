from django.shortcuts import render
from .models import Product, Category

def index(request):
    categories = Category.objects.all
    products = Product.objects.all

    context = {
        "categories" : categories,
        "products" : products,
    }

    return render(request, 'core/index.html', context)


def about(request):
    return render(request, 'core/about.html')
