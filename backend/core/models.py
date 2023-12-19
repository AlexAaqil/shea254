from django.db import models
from ckeditor_uploader.fields import RichTextUploadingField
from django.utils.html import mark_safe


STATUS = (
    ("draft", "Draft"),
    ("disabled", "Disabled"),
    ("in_review", "In Review"),
    ("rejected", "Rejected"),
    ("published", "Published"),
)


class Category(models.Model):
    title = models.CharField(max_length=255, unique=True)
    slug = models.SlugField(unique=True)
    image = models.ImageField(upload_to="uploads/categories", default="category.jpg")

    class Meta:
        verbose_name_plural = "Categories"

    def category_image(self):
        return mark_safe('<img src="%s" width=50 height=50>' % (self.image.url))

    def __str__(self):
        return self.title


class Product(models.Model):
    title = models.CharField(max_length=100, default="Product Title")
    category = models.ForeignKey(Category, on_delete=models.SET_NULL, null=True)
    description = RichTextUploadingField(null=True, blank=True, default="Product Description")
    price = models.DecimalField(max_digits=999999999999, decimal_places=2, default="0.00")
    new_price = models.DecimalField(max_digits=999999999999, decimal_places=2, default="0.00")
    product_status = models.CharField(choices=STATUS, max_length=10, default="in_review")
    image = models.ImageField(upload_to="uploads/product_images", default="product.jpg")
    in_stock = models.BooleanField(default=True)
    featured = models.BooleanField(default=False)

    date = models.DateTimeField(auto_now_add=True)
    updated = models.DateTimeField(null=True, blank=True)

    class Meta:
        verbose_name_plural = "Products"

    def product_image(self):
        return mark_safe('<img src="%s" width=50 height=50>' % (self.image.url))

    def __str__(self):
        return self.title


class ProductImages(models.Model):
    images = models.ImageField(upload_to="uploads/product_images", default="Product.jpg")

    product = models.ForeignKey(Product, on_delete=models.SET_NULL, null=True, related_name="product_images")
    date = models.DateTimeField(auto_now_add=True)

    class Meta:
        verbose_name_plural = "Product Images"
