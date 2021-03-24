$(document).ready(function() {
//--------------------------------------------------------------------
// CONFIRMATION DE SUPRESSION DU COMMENT/blogPost
//-------------------------------------------------------------------
    $('.confSupCom').on('click', function(event){
      const titre = $(this).attr('data-value');
      return(confirm('"'+titre+'", Voulez-vous réellement supprimer ce commentaire ?'));
    });

  $("#show_hide_password a").on('click', function(event) {
    event.preventDefault();
    if($('#show_hide_password input').attr("type") == "text"){
      $('#show_hide_password input').attr('type', 'password');
      $('#show_hide_password i').addClass( "fa-eye-slash" );
      $('#show_hide_password i').removeClass( "fa-eye" );
    }else if($('#show_hide_password input').attr("type") == "password"){
      $('#show_hide_password input').attr('type', 'text');
      $('#show_hide_password i').removeClass( "fa-eye-slash" );
      $('#show_hide_password i').addClass( "fa-eye" );
    }
  });
});