from django.urls import path

from . import views


app_name = 'product'


urlpatterns = [
    path('shop/', views.shop, name='shop'),
    path('product/<str:slug>/', views.product_details, name='product_details'),
    path('search/', views.search, name='search'),
    path('filter_products/', views.filter_products, name='filter_products'),
]