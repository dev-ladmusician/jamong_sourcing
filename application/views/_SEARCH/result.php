<section class="jm-search">
    <div class="content-wrapper col-lg-9 col-md-9 col-sm-12">
        <div class="header solid-border-bottom"><?= '"' . $search_query . '" ' . $count ?>개의 VR컨텐츠
        <select class=" solid-border-box float-right" title="필터">
            <optgroup label="업로드 날짜">
                <option value="">오늘</option>
                <option value="">1일 전</option>
                <option value="">일주일 전</option>
                <option value="">한달 전</option>
                <option value="">1년 전</option>
            </optgroup>
            <optgroup label="정렬 기준">
                <option value="">조회수</option>
                <option value="">좋아요</option>
                <option value="">업로드 날짜</option>
            </optgroup>
            <optgroup label="기능별">
                <option value="">3D 360</option>
                <option value="">사진</option>
                <option value="">2D</option>
            </optgroup>
        </select></div>
    </div>
    </div>
</section>
