<div class="content-wrapper col-lg-9 col-md-9 col-sm-12">
    <section class="jm-search">
        <div class="row solid-border-empty">
            <div class="page-header solid-border-bottom"><?= '"' . $search_query . '" ' . $count ?>개의 VR컨텐츠
                <input id="jm-search-query" type="hidden" value="<?= $search_query ?>">
                <select title="jm-filter">
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
                </select>
            </div>


            <div class="result-list col-lg-12 col-md-12 col-sm-12 padding-outer solid-border-bottom">
            </div>

            <div class="jm-ajax-loader-container text-center">
                <img class="jm-ajax-loader" src="<?= site_url('/static/img/loader.gif') ?>"/>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 load-more padding-normal text-center">
                <a href="#">더보기<i class="glyphicon glyphicon-menu-down"></i></a>
            </div>

        </div>
    </section>
</div>