function buildChangeInput(dom)
{
    var $dom = $(dom);
    var $input = $('<input />');
    $input.attr('name', $dom.attr('name'))
        .attr('id', $dom.attr('id'))
        .css('width', '85%')
        .val($dom.text());
    $dom.after($input);
}

function change(dom, url)
{
    window.url = url;
    $(dom).hide();
    if ($(dom).next().length == 0) buildChangeInput(dom);
    $(dom).next().show().focus().select()
        .unbind('keypress')
        .keypress(function (e) {
            if (e.which == 13) 
                $(this).blur();
            else if (e.which == 27) {
                $(this).unbind('blur');
                $(this).hide();
                $(this).prev().show();
            }
        })
        .blur(function () {
            $(this).unbind('blur');
            changeEvent(this, url);
        });
}

function changeEvent(dom, url)
{
    $dom = $(dom);
    var val = $dom.val()
    var data = new Object();
    data.id = $dom.attr('id');
    eval("data."+$dom.attr('name')+"="+val);
    $.ajax({
        type: "POST",
        url: url,
        data: data,
        dataType: 'json',
        success: function (response) {
            DWZ.ajaxDone(response);
            $dom.hide();
            $dom.prev().text(val).show();
        },
        error: DWZ.ajaxError
    });
}

function reUpload(dom, event)
{
    var $dom = $(dom);
    var $file = $("<input />");
    $file.attr('type', 'file')
        .attr('name', $dom.attr('name'));
    var $cancel = $("<a />");
    $cancel.attr('href', '#')
        .text('取消')
        .click(function (event) {
            $this = $(this);
            $this.parent().parent().find(">span:first").show();
            $this.parent().remove();
            event.preventDefault();
        });
    var $container = $("<span />");
    $container.append($file).append($cancel);
    $dom.parent().parent().append($container);
    $dom.parent().hide();
    event.preventDefault();
}

function changeType(value)
{
    var $this = $(this).parent().parent().parent();
    if (value == 0) return true;
    var $container = $this.parent().find('div.container');
    if ($container.length != 0)
        $container.remove();
    $this.after($('<div class="container" />'));
    $container = $this.parent().find('div.container');
    var url = $('label', $this).attr('url');
    $.ajax({
        type: "POST",
        url: url,
        data: {type: value},
        dataType: 'html',
        success: function (response) {
            if (!response)
                alertMsg.error('错误，请联系管理员');
            else
                $container.append(response).initUI();
        },
    });
}

function pictureUploadifyComplete(event, queueId, fileObj, response, data)
{
    response =  DWZ.jsonEval(response);
    if (response.filePath)
    {
        // TODO 添加上传成功后自动添加到上部分修改排序
    }
}