let Utils = {
    datatable: function (table_id, columns, data, pageLength = 15) {
        if ($.fn.dataTable.isDataTable("#" + table_id)) {
            $("#" + table_id)
                .DataTable()
                .destroy();
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

    generateMenuItems: function() {
        const token = localStorage.getItem("user_token");
        const userData = this.parseJwt(token);
        if (!userData) return;

        // Primjer: generiši meni na osnovu role
        if (userData.role === "admin") {
            $("#menu").html(`
                <li><a href="products.html">Products</a></li>
                <li><a href="users.html">Users</a></li>
                <li><a href="orders.html">Orders</a></li>
            `);
        } else if (userData.role === "user") {
            $("#menu").html(`
                <li><a href="products.html">Products</a></li>
                <li><a href="orders.html">My Orders</a></li>
            `);
        }
    },

    loadProductsTable: function() {
        RestClient.get("product", function(data) {
            const columns = [
                { title: "ID", data: "id" },
                { title: "Name", data: "name" },
                { title: "Price", data: "price" },
                { title: "Stock", data: "stock" },
            ];
            Utils.datatable("productsTable", columns, data);
        });
    }
};
