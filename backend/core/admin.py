from django.contrib import admin
from django.utils.html import format_html
from .models import Category, Product, ProductImages, CartOrder, CartOrderItem

class CategoryAdmin(admin.ModelAdmin):
    list_display = ['title', 'slug', 'category_image']


class ProductImagesAdmin(admin.TabularInline):
    model = ProductImages
    max_num = 3


class ProductAdmin(admin.ModelAdmin):
    inlines = [ProductImagesAdmin]
    list_editable = ['featured', 'in_stock']
    list_display = ['pid', 'product_image', 'title', 'category', 'price', 'featured', 'in_stock']


admin.site.register(Category, CategoryAdmin)
admin.site.register(Product, ProductAdmin)
admin.site.register(CartOrder)
admin.site.register(CartOrderItem)
