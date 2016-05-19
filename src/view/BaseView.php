<?php

abstract class BaseView {

    /**
     * 総レコード数を取得する
     * @return int Viewで表示している件数ではなく、テーブルに保存されている総レコード数。int型にキャストして返却。
     */
    protected abstract function getMaxRowCount();

    /**
     * スレッドやレスポンスの最大表示数を取得する。
     * @return int スレッドやレスポンスの最大表示数を返す。返却時はint型にキャストする。
     */
    public abstract function getLimitDisplaySize();

    /**
     * $_GET['page']に保存されている現在のページ番号を取得する。
     * @return int 現在のページ番号を返す。|$_GET['page']に値がない場合は、1を返す。
     */
    protected function getCurrentPageNumber() {
        return isset($_GET['page']) ? (int) $_GET['page'] : 1;
    }

    /**
     * 前ページが存在するかを調べる
     * @param $previousPage int 前ページのページ番号
     * @return bool 前ページが存在する場合はtrue|そうでない場合はfalse
     */
    private function isPreviousPageExists($previousPage) {
        return $previousPage > 0;
    }

    /**
     * 次ページが存在するかを調べる
     * @param $nextPage int 次ページのページ番号
     * @return bool 次ページが存在する場合はtrue|そうでない場合はfalse
     */
    private function isNextPageExists($nextPage) {
        $offset = $this->getLimitDisplaySize() * $nextPage;
        return $offset < $this->getMaxRowCount() || $offset - $this->getMaxRowCount() < $this->getLimitDisplaySize();
    }

    /**
     * 前のページを取得する
     * @param $message string <a>タグに表示するメッセージ
     * @return string 前ページが存在する場合は前ページのリンクが入ったアンカータグを返す。|そうでない場合は$messageをそのまま返す。
     */
    public function getPreviousPage($message) {
        $previousPage = $this->getCurrentPageNumber() - 1;

        return self::isPreviousPageExists($previousPage) ?
            $this->getAnchorTagToPage($previousPage, $message) : $message;
    }

    /**
     * 次ページを取得する
     * @param $message string <a>タグに表示するメッセージ
     * @return string 次ページが存在する場合は次ページのリンクが入ったアンカータグを返す。|そうでない場合は$messageをそのまま返す。
     */
    public function getNextPage($message) {
        $nextPage = $this->getCurrentPageNumber() + 1;

        return self::isNextPageExists($nextPage) ?
            $this->getAnchorTagToPage($nextPage, $message) : $message;
    }

    /**
     * ページのリンクが入ったアンカータグを取得する
     * @param $pageNumber int ページ番号
     * @param $message string <a>タグに表示するメッセージ
     * @return string 遷移先のページ番号のリンクが入ったアンカータグを返す。
     */
    protected function getAnchorTagToPage($pageNumber, $message) {
        return "<a href='{$_SERVER['SCRIPT_NAME']}?page={$pageNumber}'>{$message}</a>";
    }

}