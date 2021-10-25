$(function(){
  //以下モーダル
  $('article').click(function(){
      var $title = $(this).find('.article-title').text();
      var $content = $(this).find('.article-content').text();
      var $image = $(this).find('img').attr('src');

      $('.modal-title').text($title);
      $('.modal-content').text($content);
      $('.modal-img').attr('src',$image);
      $('.modal').css('display','block');
  });

  $('.modal').click(function(){
      $('.modal').css('display', 'none');
  });

  //以下ハンバーガー
  $('.nav-toggle').click(function(){
      $('.nav-wrapper').toggleClass('open');
      $('.nav-toggle').toggleClass('open');
  });
});