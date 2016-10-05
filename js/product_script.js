// $(document).ajaxError(function () {
//                alert("AJAX request failed");
//            });
//            function getProductByID(ID) {
//               
//                $.ajax({
//                    url: "/api.php/product/" + ID,
//                    type: "GET",
//                    dataType: "json"
//                }).done(function (data) {
//                    alert(data['price']);
//                    $('#productPrice').text(data['price']);
//                   /* var result = '<tbody>';
//                    for (var i = 0; i < data.length; i++) {
//                        var item = data[i];
//                        var checked = (item.isDone == 'true') ? 'checked' : "";
//                        result += "\
//                    <tr class='rows'>\n\
//                    <td>" + item.ID + "</td>\n\
//                    <td>" + item.title + "</td>\n\
//                    <td>" + item.dueDate + "</td>\n\
//                    <td><input type='checkbox' " + checked + "></td></tr>";
//
//                    }
//                    result += "</tbody>";
//                    $('#todoList tbody').html("");
//
//                    $('#todoList thead').after(result); */
//                });
//            }

            $(document).ready(function () {
               var ratingsResult = "";
               var reviewStars = Math.round($('#averageStars').text());
               for (var i=0; i< reviewStars; i++){
                   ratingsResult += "<span class='glyphicon glyphicon-star'></span>";                                   
               }
                for (var i=0; i< 5-reviewStars; i++){
                   ratingsResult += "<span class='glyphicon glyphicon-star-empty'></span>";                                   
               }
               ratingsResult += "&nbsp" + reviewStars + " stars";

               $('#averageStars').html(ratingsResult);
               
               $('#leaveReview').click(function() {
                   $('#reviewForm').show();
               });
               
               
               
//                getProductByID($('#productID').text());
//                
//       
//                $("#addTodo").click(function () {
//                    var title = $("input[name=title]").val();
//                    var dueDate = $("input[name=dueDate]").val();
//                    if(!validateInput(title, dueDate)){
//                        return;
//                    }
//                    $.ajax({
//                        url: "/api.php/todoitems",
//                        data: JSON.stringify({
//                            title: title,
//                            dueDate: dueDate,
//                            isDone: 'false',
//                        }),
//                        type: "POST",
//                        dataType: "json"
//                    }).done(function () {
//                        getToDoList();
//                        alert("addedd successfully");
//                    });
//                });
//                $('#todoList').on("click", ".rows", function (e) {
//                    //Change color of the clicked row to make it look like it's selected
//                    $(this).closest('tr').css({backgroundColor: 'grey'});
//                    $(this).closest('tr').siblings().css({backgroundColor: 'white'});
//                    //Get the seleceted Item ID
//                    var todoID = $(this).closest('tr').children('td:first').text();
//                    $.ajax({
//                        url: "/api.php/todoitems/" + todoID,
//                        // data: {},
//                        type: "GET",
//                        dataType: "json"
//                    }).done(function (data) {
//                        $("input[name=itemId]").val(data.ID);
//                        $("input[name=titleToEdit]").val(data.title);
//                        $("input[name=dueDateToEdit]").val(data.dueDate);
//                        if (data.isDone == 'true') {
//                            $('input[name=isDoneToEdit]').prop('checked', true);
//                        } else {
//                            $('input[name=isDoneToEdit]').removeProp('checked');
//                        }
//
//                    });
//                });
//                $("#cancelTodo").click(function () {
//                    $("input[name=itemId]").val("");
//                    $("input[name=titleToEdit]").val("");
//                    $("input[name=dueDateToEdit]").val("");
//                    $('input[name=isDoneToEdit]').prop('checked', false);
//                });
//                $("#deleteTodo").click(function () {
//                    //get current selected item
//                    var ID = $("input[name=itemId]").val();
//                    if(ID == ""){
//                        alert("There is currently no item to delete");
//                        return;
//                    }
//                    $.ajax({
//                        url: "/api.php/todoitems/" + ID,
//                        type: "DELETE",
//                        dataType: "json"
//                    }).done(function () {
//                        //Refresh the table
//                        getToDoList();
//                        alert("The record " + ID + " was deleted");
//                    });
//                });
//                 $("#saveTodo").click(function () {
//                    //get current selected item
//                    var ID = $("input[name=itemId]").val();
//                    if(ID == ""){
//                        alert("There is currently no item to save");
//                        return;
//                    }
//                    var title = $("input[name=titleToEdit]").val();
//                    var dueDate = $("input[name=dueDateToEdit]").val();
//                    if(!validateInput(title, dueDate)){
//                        return;
//                    }
//                    
//                    var isChecked =  $('input[name=isDoneToEdit]').prop('checked') ? "true" : "false";
//                    $.ajax({
//                        url: "/api.php/todoitems/" + ID ,
//                        data: JSON.stringify({
//                            title: title,
//                            dueDate: dueDate,
//                            isDone: isChecked
//                        }),
//                        type: "PUT",
//                        dataType: "json"
//                    }).done(function () {
//                        getToDoList();
//                        alert("updated successfully");
//                    });
//                });
            });

