let Utils = {
    datatable: function (table_id, columns, data, pageLength = 15) {
        if ($.fn.dataTable.isDataTable("#" + table_id)) {
            $("#" + table_id).DataTable().destroy();
        }
        $("#" + table_id).DataTable({
            data: data,
            columns: columns,
            pageLength: pageLength,
            lengthMenu: [2, 5, 10, 15, 25, 50, 100, "All"],
        });
    },

    parseJwt: function(token) {
        if (!token) return null;
        try {
            const payload = token.split('.')[1];
            const decoded = atob(payload);
            return JSON.parse(decoded);
        } catch (e) {
            console.error("Invalid JWT token", e);
            return null;
        }
    },


    loadProductsTable: function() {
        RestClient.get("products", function(data) {
            const columns = [
                { title: "ID", data: "id" },
                { title: "Name", data: "name" },
                { title: "Price", data: "price" },
                { title: "Stock", data: "stock" },
                { 
                    title: "Actions", 
                    data: null, 
                    render: function(data, type, row) {
                        return `
                            <button class="btn btn-sm btn-primary" onclick="ProductService.openEditModal(${row.id})">Edit</button>
                            <button class="btn btn-sm btn-danger" onclick="ProductService.openConfirmationDialog('${row.id}')">Delete</button>
                        `;
                    }
                }
            ];
            
            Utils.datatable("productsTable", columns, data);
        }, function(error) {
            toastr.error("Could not load products");
        });
    }
};