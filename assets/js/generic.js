$('.inputform').on('keydown', 'input', function (event) {
    if (event.which == 13) {
        var $allInputs = $('.inputform input, .inputform select')
        var $this = $(event.target);
        var index = $allInputs.index($this);
        if($this.val().length != 0){
            if (index < $allInputs.length - 1) {
                event.preventDefault();
                console.log($this.next('input').is('[readonly]'));
                if ($this.next('input').is('[readonly]') ) {
                    $allInputs[index+2].focus()
                }
                else{
                    $allInputs[index+1].focus()
                }
            }
        }
        else{
            $allInputs[index].focus()
            return false;
        }
    }
});


$('body').on('keydown', function(e) {
  var keyCode = e.keyCode || e.which;
  var tag = e.target.tagName
  if (keyCode === 13 && tag !=="TEXTAREA") {
    console.log("Enter prevented")
    e.preventDefault();
    return false;
  }else{
    console.log("Enter is ok...")
  }
});

$(document).ready(function () {
    var lang = document.getElementById("selected_lang").value;
    changeLanguage(lang);
  });
  
  function changeLanguage(lang){
    if(lang == 2){
      $("#selected_lang").attr('value', '2');
      $(".en").css("display", "none");
      $(".ar").css("display", "inline-block");
      $(".metismenu .en").css("display", "none");
      $(".metismenu .ar").css("display", "contents");
      $(".add_me").addClass("rv");
      $(".ar").addClass("tb");
      $(".alignChange").css("display", "contents");
      $(".alignChange").css("right", "5px");
      $(".flexDirection").css("flex-direction", "row-reverse");
      $(".align_center").css("display", "block");
      $(".align_center").css("text-align", "center");
      $(".direction").addClass("direction-rtl");
      $(".direction").removeClass("direction-ltr");
      $(".metismenu").addClass("pr-0");
      $(".nav-second-level").css("left", "-196px");
      $(".nav-second-level").css("right", "auto");
    }
    else{
      $("#selected_lang").attr('value', '1')
      $(".en").css("display", "inline-block");
      $(".ar").css("display", "none");
      $(".metismenu .en").css("display", "contents");
      $(".metismenu .ar").css("display", "none");
      $(".add_me").removeClass("rv");
      $(".ar").removeClass("tb");
      $(".alignChange").css("display", "block");
      $(".alignChange").css("right", "10px");
      $(".flexDirection").css("flex-direction", "row");
      $(".direction").addClass("direction-ltr");
      $(".direction").removeClass("direction-rtl");
      $(".metismenu").removeClass("pr-0");
      $(".nav-second-level").css("right", "-192px");
      $(".nav-second-level").css("left", "auto");
    }
    $.post("changeLanguage.php", { lang: lang });
  }