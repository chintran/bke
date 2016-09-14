<?php
class Constant{
	public static $KEY_ADMIN_STATE = "NV_ADMIN_STATE";
	public static $KEY_ADMIN_MESSAGE = 'NV_KEY_ADMIN_MSG';
	public static $TIMER_START = 'NV_TIMER_START';

	public static $PER_ROW_PAGE = 5;
	public static $NUM_LINK_PAGE = 4;
	public static $NUM_STAGE = 10;

	public static $COMP_PLAY = 'NV_COMPTITION_PLAY';
	public static $KEY_USER_STATE = 'NV_USER_STATE';
	public static $KEY_MESSAGE = 'NV_KEY_MESSAGE';
	public static $KEY_LANG = "NV_LANG_STATE";
	public static $LANGUAGE = array('vn'=>'vietnamese', 'en'=>'english');
	public static $LIMIT_PIC_UPLOAD = 1048;
	public static $ALLOW_PIC_UPLOAD = 'gif|jpg|png';
	public static $PROG_LANGS = array('c++','java','python');
	public static $CONS_WEBSITE = 'BKE';
	public static $CONS_HOME = 'home';
	public static $CONS_SOLUTIONS = 'solution';
	public static $CONS_INTRO = 'introduce';
	public static $CONS_TECH = 'technology';
	public static $CONS_PROJ = 'project';
	public static $CONS_CONTACT = 'contact';
	public static $RELATE_PROJECT = 6;

}

class CompStatus{
	public static $UP = 0;
	public static $LIVE = 1;
	public static $END = 2;

}

class QuizType{
	public static $PROG = 0;
	public static $OPT = 1;
}

class StudentComp{
	public static $REGISTED = 0;
	public static $PRACTICE = 1;
	public static $DONE = 2;
}
