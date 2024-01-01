import os
from django.db import models
from django.utils.html import mark_safe
from django.core.exceptions import ValidationError
from django.utils.text import slugify
from django.utils import timezone

from decimal import Decimal
from shortuuid.django_fields import ShortUUIDField
from ckeditor_uploader.fields import RichTextUploadingField


STATUS = (
    ("disabled", "Disabled"),
    ("published", "Published"),
)

ORDER_STATUS = (
    ("pending", "Pending"),
    ("processed", "Processed"),
)


class CategoryAndProduct(models.Model):
    slug = models.SlugField(unique=True, blank=True)

    def save(self, *args, **kwargs):
        if not self.slug or self.title != self._meta.model.objects.get(pk=self.pk).title:
            self.slug = slugify(self.title)
        super().save(*args, **kwargs)

    def admin_panel_image(self):
        if self.image:
            return mark_safe('<img src="%s" width=50 height=50>' % (self.image.url))
        return mark_safe('<img src="%s" width=50 height=50>' % '/static/images/default_product.jpg')

    def imageURL(self):
        try:
            url = self.image.url
        except:
            url = '/static/images/default_product.jpg'
        return url

    class Meta:
        abstract = True


class ProductSize(models.Model):
    title = models.CharField(unique=True, max_length=15)

    def __str__(self):
        return self.title


class Category(CategoryAndProduct):
    cid = ShortUUIDField(unique=True, length=10, max_length=20, prefix="cat", alphabet="abcdefg12345")
    title = models.CharField(max_length=255, unique=True)
    image = models.ImageField(upload_to="uploads/categories", blank=True, null=True)

    class Meta:
        verbose_name_plural = "Categories"

    def save(self, *args, **kwargs):
        image_filename = f"category_{self.id}_{timezone.now().strftime('%m%d%Y')}.jpg"
        self.image.name = image_filename

        super().save(*args, **kwargs)


    def __str__(self):
        return self.title


class Product(CategoryAndProduct):
    pid = ShortUUIDField(unique=True, length=10, max_length=20, alphabet="abcdefg12345")

    category = models.ForeignKey(Category, on_delete=models.SET_NULL, null=True)
    title = models.CharField(unique=True, max_length=100, default="Product Title")
    description = RichTextUploadingField(null=True, blank=True, default="Product Description")
    size = models.ForeignKey(ProductSize, on_delete=models.SET_NULL, null=True, blank=True)

    price = models.DecimalField(max_digits=999999999999, decimal_places=2, default=Decimal('0.00'))
    discount_price = models.DecimalField(max_digits=999999999999, decimal_places=2, default=Decimal('0.00'))

    product_status = models.CharField(choices=STATUS, max_length=10, default="published")
    in_stock = models.BooleanField(default=True)
    featured = models.BooleanField(default=False)

    image = models.ImageField(upload_to="uploads/product_images", blank=True, null=True)

    created_at = models.DateTimeField(auto_now_add=True)
    updated_at = models.DateTimeField(null=True, blank=True)

    class Meta:
        verbose_name_plural = "Products"

    def __str__(self):
        return self.title


class ProductImages(models.Model):
    images = models.ImageField(upload_to="uploads/product_images", default="Product.jpg")

    product = models.ForeignKey(Product, on_delete=models.SET_NULL, null=True, related_name="product_images")
    created_at = models.DateTimeField(auto_now_add=True)

    def clean(self):
        if self.product.product_images.count() >= 3:
            raise ValidationError("Maximum of 3 images allowed per product.")

    def delete(self, *args, **kwargs):
        # Call the original delete() method first
        super().delete(*args, **kwargs)

        # Delete the associated image file from the storage
        self.images.storage.delete(self.images.name)

    class Meta:
        verbose_name_plural = "Product Images"


class CustomerInformation(models.Model):
    first_name = models.CharField(max_length=50, null=True)
    last_name = models.CharField(max_length=80, null=True)
    email_address = models.EmailField()
    phone_number = models.CharField(max_length=20, null=True)
    address = models.CharField(max_length=255, null=True)
    additional_information = models.TextField(blank=True, null=True)

    class Meta:
        verbose_name_plural = "Customers Information"

    def __str__(self):
        return f"{self.first_name} {self.last_name}"


class CartOrder(models.Model):
    oid = ShortUUIDField(unique=True, length=10, max_length=20, prefix="order", alphabet="abcdefg12345")
    customer = models.ForeignKey(CustomerInformation, on_delete=models.SET_NULL, blank=True, null=True, default=None)
    order_status = models.CharField(choices=ORDER_STATUS, max_length=10, default="pending")
    payment_status = models.BooleanField(default=False)
    created_at = models.DateTimeField(auto_now_add=True)

    @property
    def get_cart_total_amount(self):
        order_items = self.order_items.all()
        total = sum([item.get_items_total for item in order_items])
        return total

    @property
    def get_cart_total_items(self):
        order_items = self.order_items.all()
        total = sum([item.quantity for item in order_items])
        return total

    def __str__(self):
        return f"Order #{self.oid}"


class CartOrderItem(models.Model):
    product = models.ForeignKey(Product, on_delete=models.SET_NULL, blank=True, null=True)
    order = models.ForeignKey(CartOrder, on_delete=models.SET_NULL, blank=True, null=True, related_name='order_items')
    quantity = models.IntegerField(default=1)
    created_at = models.DateTimeField(auto_now_add=True)

    @property
    def get_items_total(self):
        return self.product.price * self.quantity

    def __str__(self):
        return f"Order #{self.product.title}"
