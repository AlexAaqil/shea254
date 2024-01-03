from django.db import models
from product.models import Product

from shortuuid.django_fields import ShortUUIDField

from core.models import CustomerInformation
from product.models import Product


ORDER_STATUS = (
    ("pending", "Pending"),
    ("processed", "Processed"),
)


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
