from django.contrib import admin
from .models import Category, Product, ProductImages, Order

class CategoryAdmin(admin.ModelAdmin):
    list_display = ['title', 'slug', 'category_image']


class ProductImagesAdmin(admin.TabularInline):
    model = ProductImages
    max_num = 3


class ProductAdmin(admin.ModelAdmin):
    inlines = [ProductImagesAdmin]
    list_editable = ['featured', 'in_stock']
    list_display = ['pid', 'product_image', 'title', 'category', 'price', 'featured', 'in_stock']


class OrderAdmin(admin.ModelAdmin):
    list_display = ['oid', 'first_name', 'last_name', 'email_address']


admin.site.register(Category, CategoryAdmin)
admin.site.register(Product, ProductAdmin)
admin.site.register(Order, OrderAdmin)
