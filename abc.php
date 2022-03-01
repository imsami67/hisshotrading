


<script type="text/javascript">
       var i = 1
        function Add() {

          var product_name=  $('#product_id').val($('#product_id').text());
            var quantity = document.getElementById("quantity");
            AddRow(product_name,quantity.value);
            product_name.value = "";
            quantity.value = "";
        };
 
        function Remove(button) {
            //Determine the reference of the Row using the Button.
            var row = button.parentNode.parentNode;
            var name = row.getElementsByTagName("TD")[0].innerHTML;
 
                //Get the reference of the Table.
                var table = document.getElementById("myDiv");
 
                //Delete the Table row using it's Index.
                table.deleteRow(row.rowIndex);
            
        };
 
        function AddRow(name, country) {
            //Get the reference of the Table's TBODY element.
            var tBody = document.getElementById("myDiv").getElementsByTagName("TBODY")[0];
 
            //Add Row.
            row = tBody.insertRow(-1);
 
            //Add Name cell.
            var cell = row.insertCell(-1);
            cell.innerHTML = i++;

            
            //Add Country cell.
            cell = row.insertCell(-1);
            cell.innerHTML = name;

             cell = row.insertCell(-1);
            cell.innerHTML = country;

             cell = row.insertCell(-1);
            cell.innerHTML = country;

             cell = row.insertCell(-1);
            cell.innerHTML = country;
 
            //Add Button cell.
            cell = row.insertCell(-1);
            var btnRemove = document.createElement("INPUT");
            btnRemove.type = "button";
            btnRemove.value = "Remove";
            btnRemove.setAttribute("onclick", "Remove(this);");

            cell.appendChild(btnRemove);
        }
    </script>
