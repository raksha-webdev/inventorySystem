

<style>

    /* ================================
       CATEGORY TABLE
    ================================= */

    .category-card {
        background: #ffffff;
        border-radius: 12px;
        border: 1px solid #e9ecef;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    .category-card-header {
        padding: 20px 24px;
        border-bottom: 1px solid #eeeeee;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
    }

    .category-card-header h4 {
        margin: 0;
        font-size: 20px;
        font-weight: 600;
        color: #2c3e50;
    }

    .category-card-header p {
        margin: 5px 0 0;
        color: #8898aa;
        font-size: 13px;
    }


    /* ================================
       ADD BUTTON
    ================================= */

    .add-category-btn {
        background: #4169e1;
        color: #ffffff;
        padding: 10px 18px;
        border-radius: 7px;
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 7px;
        transition: 0.2s ease;
        white-space: nowrap;
    }

    .add-category-btn:hover {
        color: #ffffff;
        background: #3157c7;
        text-decoration: none;
        transform: translateY(-1px);
    }


    /* ================================
       TABLE
    ================================= */

    .category-table-wrapper {
        width: 100%;
        overflow-x: auto;
    }

    .category-table {
        width: 100%;
        min-width: 700px;
        border-collapse: collapse;
    }

    .category-table thead th {
        background: #f8f9fc;
        color: #6b7280;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        padding: 15px 20px;
        border-bottom: 1px solid #e9ecef;
        white-space: nowrap;
    }

    .category-table tbody td {
        padding: 15px 20px;
        border-bottom: 1px solid #f0f1f3;
        vertical-align: middle;
        color: #374151;
        font-size: 14px;
    }

    .category-table tbody tr {
        transition: 0.2s ease;
    }

    .category-table tbody tr:hover {
        background: #fafbff;
    }

    .category-table tbody tr:last-child td {
        border-bottom: none;
    }


    /* ================================
       SERIAL NUMBER
    ================================= */

    .serial-number {
        color: #6b7280;
        font-weight: 500;
    }


    /* ================================
       CATEGORY IMAGE
    ================================= */

    .category-image {
        width: 52px;
        height: 52px;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid #e5e7eb;
        background: #f8f9fa;
    }

    .category-image-placeholder {
        width: 52px;
        height: 52px;
        border-radius: 8px;
        background: #f1f3f5;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #adb5bd;
        font-size: 20px;
    }


    /* ================================
       CATEGORY NAME
    ================================= */

    .category-name {
        font-weight: 600;
        color: #2d3748;
    }


    /* ================================
       STATUS
    ================================= */

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .status-badge i {
        font-size: 7px;
    }

    .status-active {
        background: #eaf8ef;
        color: #198754;
    }

    .status-inactive {
        background: #fff1f1;
        color: #dc3545;
    }


    /* ================================
       ACTION BUTTONS
    ================================= */

    .action-buttons {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .action-btn {
        width: 34px;
        height: 34px;
        border-radius: 7px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #e5e7eb;
        background: #ffffff;
        text-decoration: none;
        transition: 0.2s ease;
        font-size: 14px;
    }

    .edit-btn {
        color: #4169e1;
    }

    .edit-btn:hover {
        background: #4169e1;
        color: #ffffff;
        border-color: #4169e1;
    }

    .delete-btn {
        color: #dc3545;
    }

    .delete-btn:hover {
        background: #dc3545;
        color: #ffffff;
        border-color: #dc3545;
    }


    /* ================================
       EMPTY DATA
    ================================= */

    .empty-category {
        text-align: center;
        padding: 50px 20px !important;
        color: #9ca3af !important;
    }

    .empty-category i {
        font-size: 40px;
        margin-bottom: 10px;
        display: block;
        color: #cbd5e1;
    }

    .empty-category strong {
        display: block;
        color: #6b7280;
        font-size: 15px;
        margin-bottom: 4px;
    }


    /* ================================
       MOBILE
    ================================= */

    @media (max-width: 767px) {

        .category-card-header {
            padding: 16px;
            flex-direction: column;
            align-items: flex-start;
        }

        .add-category-btn {
            width: 100%;
            justify-content: center;
        }

        .category-table thead th,
        .category-table tbody td {
            padding: 12px 14px;
        }

    }

</style>





                            