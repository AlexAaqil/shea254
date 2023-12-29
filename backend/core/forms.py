from django import forms


class BillingInformationForm(forms.Form):
    first_name = forms.CharField(max_length=50, required=True)
    last_name = forms.CharField(max_length=80, required=True)
    email_address = forms.EmailField(required=True)
    phone_number = forms.CharField(max_length=20, required=True)
    address = forms.CharField(max_length=250)
    additional_information = forms.CharField(widget=forms.Textarea(attrs={'rows': 7}), required=False)