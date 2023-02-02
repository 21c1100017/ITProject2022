$(function(){
    $('.favorite-button').on('click', function(){
        var btn = $(this);
        var post_id = btn.closest('.post-box')[0].id;
        $.ajax({
            url: '../ajax/favorite.php',
            type: 'POST',
            data: {'post_id': post_id},
            dataType: 'json'
        })
        .done(function(data, textStatus, jqXHR){
            var element = document.getElementById(post_id);
            var element2 = element.getElementsByClassName('favorite-label');
            element2[0].innerText = data[2];
        })
        .fail(function(jqXHR, textStatus, errorThrown){
            return;
        });
    });
});
