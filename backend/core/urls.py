from django.urls import path
from . import views


app_name = 'core'


urlpatterns = [
    path('', views.index, name='index'),

    path('shop/', views.shop, name='shop'),
    path('product/<pid>', views.product_details, name='product_details'),
    path('search/', views.search, name='search'),
    path('filter_products/', views.filter_products, name='filter_products'),

    path('cart/', views.cart, name='cart'),
    path('cart/add/', views.add_to_cart, name='add_to_cart'),

    path('about/', views.about, name='about'),
    path('contact/', views.contact, name='contact'),
]