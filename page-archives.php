<?php
/**
 * 归档页面
 *
 * @package custom
 */
if (!defined("__TYPECHO_ROOT_DIR__")) {
  exit();
} ?>
<!DOCTYPE html>
<html lang="zh">
<?php $this->need("header.php"); ?>
<body class="jasmine-body">
<div class="jasmine-container grid grid-cols-12">
<?php $this->need("component/sidebar-left.php"); ?>
        <div class="flex col-span-12 lg:col-span-8 flex-col border-x-2 border-stone-100 dark:border-neutral-600 lg:pt-0 lg:px-6 pb-10 px-3">
            <?php $this->need("component/menu.php"); ?>
            <div class="flex flex-col gap-y-12">
                <div class="flex px-3 flex-col">
                    <?php
                    $archives = getArchives($this);
                    $number = 0;
                    foreach ($archives as $year => $posts) {
                      $open = $number === 0 ? null : " closed";
                      echo '<h2 class="archive-year title text-3xl my-2 dark:text-neutral-300 jasmine-primary-color archive-title">' .
                        $year .
                        " 年</h2>";
                      echo '<ol id="flex flex-col archive-list-' .
                        $year .
                        '" class="archive-list jasmine-primary-color' .
                        $open .
                        '">';
                      foreach ($posts as $created => $post) {
                        if (isShuoShuoType($post["cid"])) {
                          continue;
                        }
                        echo '<li class="archive-item"><a href="' .
                          $post["permalink"] .
                          '" class="no-line archive-item-link">'.
                            $post["title"].
				'<span class="archive-date"> - ' .
                          date("m-d", $created) .
                          '</span></a></li>';
                      }
                      echo "</ol>";
                      $number++;
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="hidden lg:col-span-3 lg:block" id="sidebar-right">
            <?php $this->need("component/sidebar.php"); ?>
        </div>
    </div>
    <?php $this->need("footer.php"); ?>
</body>
</html>
