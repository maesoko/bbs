<?php

abstract class BaseView {

    /**
     * 総レコード数を取得する
     * @return int Viewで表示している件数ではなく、テーブルに保存されている総レコード数。int型にキャストして返却。
     */
    protected abstract function getMaxRowCount();

}