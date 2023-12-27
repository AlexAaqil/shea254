from django.contrib import admin
from .models import Category, Product, ProductImages

class CategoryAdmin(admin.ModelAdmin):
    list_display = ['title', 'slug', 'category_image']


class ProductImagesAdmin(admin.TabularInline):
    model = ProductImages
    max_num = 3


class ProductAdmin(admin.ModelAdmin):
    inlines = [ProductImagesAdmin]
    list_display = ['pid', 'title', 'product_image', 'category', 'price', 'featured', 'product_status']


admin.site.register(Category, CategoryAdmin)
admin.site.register(Product, ProductAdmin)
