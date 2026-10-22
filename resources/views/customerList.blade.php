
@extends('admin_master')

@section('content')

<style>
    .customer-page {
        padding: 24px;
        background: #f5f7fb;
        min-height: 100vh;
    }

    .customer-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 24px;
    }

    .customer-header h3 {
        color: #1e293b;
        font-weight: 700;
        margin: 0 0 5px;
    }

    .customer-header p {
        color: #64748b;
        margin: 0;
        font-size: 14px;
    }

    .customer-card {
        background: #fff;
        border: 1px solid #e8edf4;
        border-radius: 14px;
        box-shadow: 0 4px 20px rgba(15, 23, 42, .04);
        overflow: hidden;
    }

    .customer-toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
        padding: 20px;
        border-bottom: 1px solid #edf0f5;
    }

    .customer-search {
        width: 100%;
        max-width: 340px;
        border: 1px solid #dbe2ea;
        border-radius: 9px;
        padding: 10px 14px;
        outline: none;
    }

    .customer-search:focus,
    .form-control:focus {
        border-color: #4169e2;
        box-shadow: 0 0 0 3px rgba(65, 105, 226, .10);
    }

    .btn-customer {
        background: #4169e2;
        color: #fff;
        border: none;
        padding: 10px 17px;
        border-radius: 9px;
        font-weight: 600;
    }

    .btn-customer:hover {
        background: #3154c5;
        color: #fff;
    }

    .customer-table {
        min-width: 1000px;
        margin-bottom: 0;
    }

    .customer-table thead th {
        background: #f8fafc;
        color: #64748b;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: .5px;
        padding: 15px;
        white-space: nowrap;
        border-bottom: 1px solid #e8edf4;
    }

    .customer-table tbody td {
        padding: 15px;
        vertical-align: middle;
        color: #334155;
        font-size: 14px;
        border-bottom: 1px solid #f0f2f6;
    }

    .customer-name {
        font-weight: 600;
        color: #1e293b;
    }

    .customer-id {
        color: #64748b;
        font-size: 12px;
    }

    .customer-avatar {
        width: 40px;
        height: 40px;
        flex-shrink: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        background: #e8edff;
        color: #4169e2;
        font-weight: 700;
        border-radius: 10px;
    }

    .btn-edit {
        border: 1px solid #dbe5ff;
        background: #f0f4ff;
        color: #3154c5;
        padding: 7px 12px;
        border-radius: 7px;
        font-size: 13px;
        font-weight: 600;
    }

    .btn-edit:hover {
        background: #dfe8ff;
    }

    .btn-delete {
        border: 1px solid #dbe5ff;
        background:black;
        color: #fff;
        padding: 7px 12px;
        border-radius: 7px;
        font-size: 13px;
        font-weight: 600;
    }

    .btn-delete:hover {
        background: #334155;
        color:#fff;
    }

    .modal-content {
        border: none;
        border-radius: 15px;
        overflow: hidden;
    }

    .modal-header {
        background: #4169e2;
        color: white;
        padding: 20px 24px;
    }

    .modal-header .btn-close {
        filter: brightness(0) invert(1);
    }

    .modal-body {
        padding: 24px;
    }

    .form-label {
        font-weight: 600;
        font-size: 13px;
        color: #334155;
        margin-bottom: 7px;
    }

    .form-control {
        border: 1px solid #dbe2ea;
        border-radius: 8px;
        padding: 10px 12px;
        font-size: 14px;
    }

    .required {
        color: #dc2626;
    }

    .empty-state {
        text-align: center;
        padding: 45px 15px;
        color: #64748b;
    }

    @media (max-width: 767px) {
        .customer-page {
            padding: 14px;
        }

        .customer-header {
            align-items: flex-start;
        }

        .customer-header .btn-customer {
            width: 100%;
        }

        .customer-toolbar {
            padding: 15px;
        }

        .customer-search {
            max-width: 100%;
        }

        .modal-body {
            padding: 18px;
        }
    }

    
/* Customer Form Panel */

.customer-form-panel {
    display: none;
    background: #fff;
    padding: 25px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
    margin-bottom: 25px;
}

.customer-form-panel.open {
    display: block;
    animation: slideDown 0.35s ease;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-12px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.customer-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.customer-header h3 {
    margin: 0;
    font-weight: 600;
}

.add-customer-btn {
    background: #4169E1;
    color: #fff;
    border: none;
    padding: 9px 18px;
    border-radius: 5px;
}

.add-customer-btn:hover {
    background: #3158d3;
    color: #fff;
}

.customer-form-title {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-bottom: 12px;
    margin-bottom: 20px;
    border-bottom: 1px solid #ddd;
}

.customer-form-title h4 {
    margin: 0;
    font-weight: 600;
}

.close-customer-form {
    border: none;
    background: transparent;
    font-size: 22px;
    color: #555;
    cursor: pointer;
}

.customer-section-title {
    background: #f5f7fb;
    border-left: 4px solid #4169E1;
    padding: 10px 15px;
    margin: 10px 0 20px;
    font-weight: 600;
}

.customer-save-btn {
    background: #4169E1;
    color: #fff;
    border: none;
    padding: 9px 25px;
    border-radius: 5px;
}

.customer-cancel-btn {
    background: #6c757d;
    color: #fff;
    border: none;
    padding: 9px 25px;
    border-radius: 5px;
}

.customer-list-box {
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
}

.customer-list-box th {
    background: #4169E1;
    color: #fff;
    white-space: nowrap;
}

.customer-list-box td {
    vertical-align: middle;
}

@media (max-width: 768px) {
    .customer-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
    }

    .customer-form-panel {
        padding: 15px;
    }
}

</style>

<div class="customer-page">

    <div class="customer-header">
        <div>
            <h3>Customer Management</h3>
            <p>Manage customer information and business details.</p>
        </div>

        <button type="button"
        class="btn btn-customer"
        id="addCustomerBtn"
        onclick="openAddCustomerForm()">
    <i class="fa fa-plus"></i> Add Customer
</button>

    </div>




    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close"
                    data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close"
                    data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Please correct the following errors:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    
<div id="customerFormPanel" class="customer-form-panel">

<div class="customer-form-title">
    <h4 id="customerFormTitle">Add Customer</h4>

    <button type="button"
            class="close-customer-form"
            onclick="closeCustomerForm()">
        <i class="fa fa-times"></i>
    </button>
</div>

<form id="customerForm"
      action="{{ url('customers/save') }}"
      method="POST">

    @csrf

    <div class="customer-section-title">
        Customer Details
    </div>

    <div class="row">

        <div class="col-md-6 mb-3">
            <label class="form-label">Customer Name *</label>
            <input type="text"
                   name="customer_name"
                   class="form-control"
                   value="{{ old('customer_name') }}"
                   placeholder="Enter customer name"
                   required>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">Company Name</label>
            <input type="text"
                   name="company_name"
                   class="form-control"
                   value="{{ old('company_name') }}"
                   placeholder="Enter company name">
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">Email *</label>
            <input type="email"
                   name="email"
                   class="form-control"
                   value="{{ old('email') }}"
                   placeholder="Enter email address"
                   required>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">Phone *</label>
            <input type="text"
                   name="phone"
                   class="form-control"
                   value="{{ old('phone') }}"
                   placeholder="Enter phone number"
                   required>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">GST Number</label>
            <input type="text"
                   name="gst_number"
                   class="form-control"
                   value="{{ old('gst_number') }}"
                   placeholder="Enter GST number">
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">PIN Code *</label>
            <input type="text"
                   name="pin_code"
                   class="form-control"
                   value="{{ old('pin_code') }}"
                   placeholder="Enter PIN code"
                   required>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">City *</label>
            <input type="text"
                   name="city"
                   class="form-control"
                   value="{{ old('city') }}"
                   placeholder="Enter city"
                   required>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">State *</label>
            <input type="text"
                   name="state"
                   class="form-control"
                   value="{{ old('state') }}"
                   placeholder="Enter state"
                   required>
        </div>

        <div class="col-12 mb-3">
            <label class="form-label">Address *</label>
            <textarea name="address"
                      class="form-control"
                      rows="3"
                      placeholder="Enter complete address"
                      required>{{ old('address') }}</textarea>
        </div>

        <div class="col-12 mb-3">
            <label class="form-label">Notes</label>
            <textarea name="notes"
                      class="form-control"
                      rows="2"
                      placeholder="Additional information">{{ old('notes') }}</textarea>
        </div>

    </div>

    <div class="d-flex justify-content-end gap-2 mt-3">

        <button type="button"
                class="customer-cancel-btn"
                onclick="closeCustomerForm()">
            Cancel
        </button>

        <button type="submit" class="customer-save-btn">
            <i class="fa fa-save"></i>
            Save Customer
        </button>

    </div>

</form>
</div>


    <div class="customer-card">

        <div class="customer-toolbar">
            <div>
                <h5 class="mb-1 fw-bold">All Customers</h5>
                <small class="text-muted">
                    Total active customers: {{ $customers->count() }}
                </small>
            </div>

            <input type="text"
                   id="customerSearch"
                   class="customer-search"
                   placeholder="Search name, phone, email...">
        </div>

        <div class="table-responsive">
            <table class="table customer-table" id="customerTable">
                <thead>
                    <tr>
                        <th>Customer</th>
                        <th>Contact</th>
                        <th>Company</th>
                        <th>Location</th>
                        <th>GST Number</th>
                        <th>Added On</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($customers as $customer)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="customer-avatar">
                                        {{ strtoupper(substr($customer->customer_name, 0, 1)) }}
                                    </div>

                                    <div>
                                        <div class="customer-name">
                                            {{ $customer->customer_name }}
                                        </div>
                                        <div class="customer-id">
                                            ID: #{{ $customer->id }}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <div>{{ $customer->phone }}</div>
                                <small class="text-muted">
                                    {{ $customer->email }}
                                </small>
                            </td>

                            <td>
                                {{ $customer->company_name ?: '—' }}
                            </td>

                            <td>
                                <div>{{ $customer->city }}</div>
                                <small class="text-muted">
                                    {{ $customer->state }}
                                </small>
                            </td>

                            <td>{{ $customer->gst_number ?: '—' }}</td>

                            <td>
                                {{ $customer->created_at
                                    ? \Carbon\Carbon::parse($customer->created_at)->format('d M Y')
                                    : '—' }}
                            </td>

                            <td>
                            <button type="button"
        class="btn-edit editCustomerBtn"
        data-id="{{ $customer->id }}"
        data-name="{{ $customer->customer_name }}"
        data-company="{{ $customer->company_name }}"
        data-email="{{ $customer->email }}"
        data-phone="{{ $customer->phone }}"
        data-gst="{{ $customer->gst_number }}"
        data-pin="{{ $customer->pin_code }}"
        data-city="{{ $customer->city }}"
        data-state="{{ $customer->state }}"
        data-address="{{ $customer->address }}"
        data-notes="{{ $customer->notes }}">
    Edit
</button>

<a href="{{ url('get_customer_sales/'.$customer->id) }}"
   class="btn btn-delete btn-sm">
    <i class="fa fa-shopping-cart"></i> View Sales
</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                <div class="empty-state">
                                    <h5>No customers found</h5>
                                    <p class="mb-0">
                                        Click Add Customer to create your first customer.
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div id="noSearchResults" class="empty-state d-none">
            <h5>No matching customers</h5>
            <p class="mb-0">Try another name, phone or email.</p>
        </div>

    </div>
</div>




<script>
document.addEventListener('DOMContentLoaded', function () {

    // Customer form elements
    const customerForm = document.getElementById('customerForm');
    const formPanel = document.getElementById('customerFormPanel');
    const formTitle = document.getElementById('customerFormTitle');
    const addButton = document.getElementById('addCustomerBtn');

    // Customer search elements
    const searchInput = document.getElementById('customerSearch');
    const tableRows = document.querySelectorAll('#customerTable tbody tr');
    const noResults = document.getElementById('noSearchResults');

    // Add Customer button
    addButton.addEventListener('click', function () {

        // Reset form fields
        customerForm.reset();

        // Set Add Customer URL
        customerForm.action = "{{ url('add_update_customer') }}";

        // Set form title
        formTitle.textContent = 'Add Customer';

        // Open form panel
        formPanel.classList.add('open');

        // Scroll to form
        formPanel.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
    });

    // Close Customer Form
    window.closeCustomerForm = function () {
        formPanel.classList.remove('open');
    };


    // Edit Customer button
document.querySelectorAll('.editCustomerBtn').forEach(function (button) {

button.addEventListener('click', function () {

    // Get selected customer ID
    const id = this.dataset.id;
    window.history.pushState({}, '', "{{ url('customers') }}/" + id);

    console.log('Selected Customer ID:', id);


    // Fill customer details in inline form
    customerForm.querySelector('[name="customer_name"]').value =
        this.dataset.name || '';

    customerForm.querySelector('[name="company_name"]').value =
        this.dataset.company || '';

    customerForm.querySelector('[name="email"]').value =
        this.dataset.email || '';

    customerForm.querySelector('[name="phone"]').value =
        this.dataset.phone || '';

    customerForm.querySelector('[name="gst_number"]').value =
        this.dataset.gst || '';

    customerForm.querySelector('[name="pin_code"]').value =
        this.dataset.pin || '';

    customerForm.querySelector('[name="city"]').value =
        this.dataset.city || '';

    customerForm.querySelector('[name="state"]').value =
        this.dataset.state || '';

    customerForm.querySelector('[name="address"]').value =
        this.dataset.address || '';

    customerForm.querySelector('[name="notes"]').value =
        this.dataset.notes || '';

    // Change form title
    formTitle.textContent = 'Edit Customer';

    customerForm.querySelector('[type="submit"]').innerHTML =
    '<i class="fa fa-save"></i> Update Customer';

    // Set update URL
    customerForm.action = "{{ url('add_update_customer') }}/" + id;

    console.log('Customer ID:', id);
console.log('Form Action URL:', customerForm.getAttribute('action'));
console.log('Resolved URL:', customerForm.action);


    // Add PUT method for Laravel update
    let methodInput = customerForm.querySelector('input[name="_method"]');

    if (!methodInput) {
        methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        customerForm.appendChild(methodInput);
    }

    methodInput.value = 'POST';

    // Open inline form
    formPanel.classList.add('open');

    // Scroll to form
    formPanel.scrollIntoView({
        behavior: 'smooth',
        block: 'start'
    });

});

});


    // Search Customers
    searchInput.addEventListener('input', function () {

        const searchValue = this.value.toLowerCase().trim();
        let visibleRows = 0;

        tableRows.forEach(function (row) {

            const rowText = row.textContent.toLowerCase();

            if (rowText.includes(searchValue)) {
                row.style.display = '';
                visibleRows++;
            } else {
                row.style.display = 'none';
            }

        });

        // Show/hide No Results message
        noResults.classList.toggle(
            'd-none',
            visibleRows > 0 || tableRows.length === 0
        );

    });

});
</script>

@endsection
