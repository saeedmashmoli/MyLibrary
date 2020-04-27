@section('script')
    <script>
        function removeArticleFile(id){
            $.ajax({
                method: "GET",
                url: '{{route('articles.files.delete')}}',
                data:{id},
                success:function (response) {
                    if(response === 'success'){
                        $('#articleFile'+id).slideUp(200);
                        setTimeout(function () {
                            $('#articleFile'+id).remove();
                        },500);
                    }
                }
            })
        }
        @if(Route::currentRouteName() == 'articles.edit')
        $("#posterEdit").fileinput({
            showUpload:false,
            previewFileIcon: "<i class='glyphicon glyphicon-king'></i>",
            overwriteInitial: true,
            initialPreviewAsData: true,
            initialPreview: [
                "{{asset($article->url)}}",
            ],
            initialPreviewConfig: [
                { url: "{{asset($article->url)}}", key: 1},
            ],
            previewFileType:'image',
            language: 'fa',
            showRemove: false,
        });
        @else
        $("#posterCreate").fileinput({
            language: 'fa',
            showUpload:false,
            previewFileType:'image',
            browseClass: "btn btn-dark",
            browseStyle: "cursor:pointer"
        });
        @endif
        $('#Files').fileinput({
            language: 'fa',
            maxFileCount: 5,
            allowedFileTypes: ["pdf"],
            browseClass: "btn btn-primary col-8",
            showCaption: false,
            showRemove: true,
            showUpload: false
        });
    </script>
@endsection
