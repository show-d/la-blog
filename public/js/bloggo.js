var hidBloggoPath = $('#hidBloggoPath').val()

$('#btnCompose').click(function () {
    location.href = '/' + hidBloggoPath + '/addEdit'
})

$('#btnBack,#btnCancel').click(function () {
    history.back()
})

$('.btnEdit').click(function () {
    location.href = '/' + hidBloggoPath + '/addEdit/' + $(this).attr('data-contentId')
})

$('.btnDeleteContent').click(function () {
    var $this = $(this)
    var tf = false
    lConfirm('确定要删除这么文章吗?', function () {
        //alert('yes')
        tf = true
        $this.parent().submit()
    }, function () {
        tf = false
    })

    return tf
})

$('.btnEditAbout').click(function () {
    var page = encodeURIComponent($(this).attr('data-Page'));
    location.href = '/' + hidBloggoPath + '/addEditCategory/' + page;
})

$('.btnRedirect').click(function () {
    var page = $(this).attr('data-Page')
    location.href = '/' + hidBloggoPath + '/' + page
})

var hidContentId = $('#hidContentId').val()
var _token = $('input[name="_token"]').val()
if (hidContentId !== undefined) {
    $.post('/content/addHitAction' ,{"_token":_token,"contentId":$('#hidContentId').val()}, function () {

    })
}
