<!DOCTYPE html>
<html>
<head>
    <title>Quản lý nhân viên</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            padding: 10px;
            background-color: #f2f2f2;
        }

        .add-button {
            background-color: #0074d9;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            border: 1px solid #ddd;
        }

        th, td {
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .action-buttons {
            display: flex;
            gap: 5px;
        }

        .form-container {
            display: none;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-top: 10px;
            width: 100%;
            max-width: 400px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LIST OF EMPLOYEES</h1>
        <button class="add-button" id="addButton">Add new Employee</button>
    </div>

    <!-- Form thêm nhân viên mới -->
    <div class="form-container" id="addForm">
        <h2>Add new Employee</h2>
        <form id="employeeForm">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required><br>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required><br>

            <label for="salary">Salary:</label>
            <input type="number" id="salary" name="salary" required><br>

            <input type="submit" value="Add Employee">
        </form>
    </div>

    <!-- Form sửa thông tin nhân viên -->
    <div class="form-container" id="editForm">
        <h2>Edit Employee</h2>
        <form id="employeeEditForm">
            <label for="editName">Name:</label>
            <input type="text" id="editName" name="editName" required><br>

            <label for="editAddress">Address:</label>
            <input type="text" id="editAddress" name="editAddress" required><br>

            <label for="editSalary">Salary:</label>
            <input type="number" id="editSalary" name="editSalary" required><br>

            <input type="hidden" id="editIndex" name="editIndex">
            <input type="submit" value="Save Changes">
            <button id="cancelEdit">Cancel</button>
        </form>
    </div>

    <!-- Bảng danh sách nhân viên -->
    <table id="employeeTable">
        <tr>
            <th>Name</th>
            <th>Address</th>
            <th>Salary</th>
            <th>Action</th>
        </tr>
    </table>

    <script>
            const addButton = document.getElementById("addButton");
        const addForm = document.getElementById("addForm");
        const editForm = document.getElementById("editForm");
        const editName = document.getElementById("editName");
        const editAddress = document.getElementById("editAddress");
        const editSalary = document.getElementById("editSalary");
        const editIndex = document.getElementById("editIndex");
        const cancelEdit = document.getElementById("cancelEdit");
        const employeeForm = document.getElementById("employeeForm");
        const employeeEditForm = document.getElementById("employeeEditForm");
        const employeeTable = document.getElementById("employeeTable");

        let data = [
            { name: "John Doe", address: "123 Main St, City", salary: "$5000" },
            { name: "Jane Smith", address: "456 Elm St, Town", salary: "$6000" }
            // Thêm các dòng khác tương tự
        ];

        function displayEmployees() {
            employeeTable.innerHTML = `
                <tr>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Salary</th>
                    <th>Action</th>
                </tr>
                ${data.map((employee, index) => `
                    <tr>
                        <td>${employee.name}</td>
                        <td>${employee.address}</td>
                        <td>${employee.salary}</td>
                        <td class="action-buttons">
                            <button class="edit-button" data-index="${index}">Edit</button>
                            <button class="delete-button" data-index="${index}">Delete</button>
                        </td>
                    </tr>
                `).join("")}
            `;

            const editButtons = document.querySelectorAll(".edit-button");
            editButtons.forEach(button => {
                button.addEventListener("click", () => {
                    const index = button.getAttribute("data-index");
                    editName.value = data[index].name;
                    editAddress.value = data[index].address;
                    editSalary.value = data[index].salary;
                    editIndex.value = index;
                    editForm.style.display = "block";
                    addForm.style.display = "none";
                });
            });

            const deleteButtons = document.querySelectorAll(".delete-button");
            deleteButtons.forEach(button => {
                button.addEventListener("click", () => {
                    const index = button.getAttribute("data-index");
                    const confirmDelete = confirm("Are you sure you want to delete this employee?");
                    
                    if (confirmDelete) {
                        data.splice(index, 1);
                        displayEmployees();
                    }
                });
            });
        }

        addButton.addEventListener("click", () => {
            addForm.style.display = "block";
            editForm.style.display = "none";
        });

        employeeForm.addEventListener("submit", (event) => {
            event.preventDefault();
            const name = document.getElementById("name").value;
            const address = document.getElementById("address").value;
            const salary = document.getElementById("salary").value;

            data.push({ name, address, salary });
            displayEmployees();
            employeeForm.reset();
        });

        employeeEditForm.addEventListener("submit", (event) => {
            event.preventDefault();
            const index = editIndex.value;
            const updatedName = editName.value;
            const updatedAddress = editAddress.value;
            const updatedSalary = editSalary.value;

            data[index] = { name: updatedName, address: updatedAddress, salary: updatedSalary };
            displayEmployees();
            editForm.style.display = "none";
        });

        displayEmployees();
    </script>
</body>
</html>