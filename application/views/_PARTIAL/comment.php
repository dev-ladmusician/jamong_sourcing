<?php if ($items != null && count($items) > 0) { ?>
<?php foreach ($items as $item) { ?>
        <li class="comment-group">
            <div class="comment-item-img">
                <?php if (strlen($item->picture) > 0) { ?>
                    <img class="jm-user-profile" src="<?php echo $item->picture ?>" alt="">
                <?php } else { ?>
                    <img class="jm-user-profile" src="<?=site_url('static/img/user.png')?>" alt="">
                <?php } ?>
            </div>
            <div class="comment-item-contents">
                <div class="comment-item-name">
                    <span><?php echo $item->nickName; ?></span>
                    <span class="comment-warning">신고</span>
                    <?php if ($item->userNumber == $this->session->userdata('userid')) { ?>
                        <span class="comment-delete" id="<?php echo $item->inum; ?>">삭제</span>
                    <?php } ?>
                </div>
                <div class="comment-item-content">
                    <?php echo $item->comments ?>
                </div>
            </div>
        </li>
<?php } ?>
<?php } ?>