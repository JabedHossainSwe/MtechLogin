
function refreshItems(div,item_id,tp)
{
document.getElementById(div).innerHTML = "<div style='background: #fff;text-align:center'><img width='80px' src='assets/img/loaders/loader.gif'/><div>";
$.post("include/generic/refreshItems.php", {item_id:item_id,tp:tp}, function (data) {
$("#"+div).html(data);
});
}

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 