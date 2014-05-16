<?php
/**
 * カレンダーヘルパー.
 *
 */
class CalendarHelper extends AppHelper {
    var $_defaultLang = 'en';
    var $_week = array(
        'en' => array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'),
        'ja' => array('日', '月', '火', '水', '木', '金', '土')
    );

    /**
     * カレンダーを生成する.
     *
     * @param string $lang 言語
     * @param integer $date 日付
     * @return カレンダー
     */
    function makeCalendar($lang = null, $date = null) {
        if (is_null($date)) {
            $date = date('Ymd');
        }
        if (is_null($lang)) {
            $lang = $this->_defaultLang;
        }

        $year = substr($date, 0, 4);
        $month = substr($date, 4, 2);
        $day = substr($date, 6, 2);
        if (!checkdate($month, $day, $year)) {
            $this->log('Invalid date format!');
        }
        return $this->output(
            "<div id=\"calendar\"><div id=\"calendar-header\">".$year."年".$month."月</div><table id=\"calendar-content\">".
            $this->_makeWeekHeader($lang).$this->_makeCalendarContent($year, $month, $date)."</table></div>"
        );
    }

    /**
     * 週ヘッダーを生成する.
     *
     * @param string $lang 言語
     * @return 週ヘッダー
     */
    function _makeWeekHeader($lang = null) {
        if (is_null($lang)) {
            $lang = $this->_defaultLang;
        }
        $cell = array();
        foreach ($this->_week[$lang] as $weekId => $week) {
            array_push($cell, "<td class=\"week_".strtolower($this->_week[$this->_defaultLang][$weekId])."\">".$week."</td>");
        }
        return "<tr id=\"week_header\">".implode("", $cell)."</tr>";
    }

    /**
     * カレンダーコンテンツを生成する.
     *
     * @param integer $year 年
     * @param integer $month 月
     * @param integer $selecteday 選択日
     * @return カレンダーコンテンツ
     */
    function _makeCalendarContent($year, $month, $selectedDay) {
        if (!is_numeric($year) || !is_numeric($month) || !is_numeric($selectedDay)) {
            throw new Exception("Invalid parameters!");
        }

        $calendar = array();
        $weekNo = 1; // 月内での週番号(第○週)
        $last = substr($this->_getLastDay($year, $month), 6, 2);
        for ($day = 1; $day <= $last; $day++) {
            $date = $year.$month.sprintf("%02d", $day); // Ymd形式
            $weekId = $this->_getWeekIdOfDay($year, $month, $day, $this->_defaultLang);
            $attr = array();
            if ($this->_getToday() == $date) {
                array_push($attr, 'today');
            }
            if ($selectedDay == $date) {
                array_push($attr, 'selected');
            }
            // TODO 祝日判定
            if (false) {
                array_push($attr, 'holiday');
            }
            $calendar[$weekNo][$weekId] = array('day' => $day, 'attribute' => $attr);
            // 翌週へ
            if ($weekId == count($this->_week[$this->_defaultLang]) - 1) {
                $weekNo++;
            }
        }
//        debug($calendar);

        $default = array('day' => '', 'attribute' => array());
        $c = array();
        for ($rowIdx = 1; $rowIdx <= count($calendar); $rowIdx++) {
            $elements = array();
            for ($colIdx = 0; $colIdx < count($this->_week[$this->_defaultLang]); $colIdx++) {
                $day = $default;
                if (array_key_exists($colIdx, $calendar[$rowIdx])) {
                    $day = $calendar[$rowIdx][$colIdx];
                }
//                debug($day);
                array_push(
                    $elements,
                    "<td class=\"week_".strtolower($this->_week[$this->_defaultLang][$colIdx])." ".implode(" ", $day['attribute'])."\">".$day['day']."</td>"
                );
            }
            array_push($c, "<tr class=\"week\">".implode("", $elements)."</tr>");
        }
        return implode("", $c);
    }

    /**
     * 月初の日付を返す.
     *
     * @param integer $year 年
     * @param integer $month 月
     * @param unknown_type $format フォーマット
     * @return 月初の日付
     */
    function _getFirstDay($year, $month, $format = 'Ymd') {
        return date($format, mktime(0, 0, 0, $month, 1, $year));
    }
    /**
     * 月末の日付を返す.
     *
     * @param integer $year 年
     * @param integer $month 月
     * @param string $format フォーマット
     * @return 月末の日付
     */
    function _getLastDay($year, $month, $format = 'Ymd') {
        return date($format, mktime(0, 0, 0, $month + 1, 0, $year));
    }
    /**
     * 日付を返す.
     *
     * @param integer $year 年
     * @param integer $month 月
     * @param integer $day 日
     * @param string $format フォーマット
     * @return 月末の日付
     */
    function _getDay($year, $month, $day, $format = 'Ymd') {
        return date($format, mktime(0, 0, 0, $month, $day, $year));
    }
    /**
     * 今日の日付を返す.
     *
     * @param string $format フォーマット
     * @return 今日の日付
     */
    function _getToday($format = 'Ymd') {
        return date($format);
    }
    /**
     * 曜日IDを返す.
     *
     * @param integer $year 年
     * @param integer $month 月
     * @param integer $day 日
     * @param string $lang 言語
     * @return 曜日ID
     */
    function _getWeekIdOfDay($year, $month, $day, $lang = null) {
        if (is_null($lang)) {
            $lang = $this->_defaultLang;
        }
        return $this->_getDay($year, $month, $day, 'w');
    }
    /**
     * 曜日を返す.
     *
     * @param integer $year 年
     * @param integer $month 月
     * @param integer $day 日
     * @param string $lang 言語
     * @return 曜日
     */
    function _getWeekOfDay($year, $month, $day, $lang = null) {
        if (is_null($lang)) {
            $lang = $this->_defaultLang;
        }
        return $this->_week[$lang][$this->_getDay($year, $month, $day, 'w')];
    }
}
?>