<?php
###############################################################################
# ASTPP - Open Source VoIP Billing Solution
#
# Copyright (C) 2016 iNextrix Technologies Pvt. Ltd.
# Samir Doshi <samir.doshi@inextrix.com>
# ASTPP Version 3.0 and above
# License https://www.gnu.org/licenses/agpl-3.0.html
#
# This program is free software: you can redistribute it and/or modify
# it under the terms of the GNU Affero General Public License as
# published by the Free Software Foundation, either version 3 of the
# License, or (at your option) any later version.
# 
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU Affero General Public License for more details.
# 
# You should have received a copy of the GNU Affero General Public License
# along with this program.  If not, see <http://www.gnu.org/licenses/>.
###############################################################################
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Refill_coupon_form {
    function __construct($library_name = '') {
        $this->CI = & get_instance();
    }
    function get_refill_coupon_form_fields(){
        $form['forms'] = array(base_url() . 'refill_coupon/refill_coupon_save/',array("id" => "refill_coupon_form", "name" => "refill_coupon_form"));
        $form['Coupon Information'] = array(
	    array('Description', 'INPUT', array('name' => 'description', 'size' => '20',  'class' => "text field medium"), 'trim|xss_clean', 'tOOL TIP', 'Please Enter account number'),
	    array('Start prefix', 'INPUT', array('name' => 'prefix', 'size' => '20',  'class' => "text field medium"), 'trim|required|numeric|xss_clean', 'tOOL TIP', ''),
            array('Quantity', 'INPUT', array('name' => 'count', 'size' => '20', 'maxlength' => '5', 'class' => "text field medium"), 'trim|required|is_numeric|greater_than[0]|xss_clean', 'tOOL TIP', 'Please Enter account number'),
            array('Amount', 'INPUT', array('name' => 'amount', 'size' => '20', 'class' => "text field medium"), 'trim|required|is_numeric|greater_than[0]|xss_clean', 'tOOL TIP', 'Please Enter account number'),
        );
       $form['button_cancel'] = array('name' => 'action', 'content' => 'Close', 'value' => 'cancel', 'type' => 'button', 'class' => 'btn btn-line-sky margin-x-10', 'onclick' => 'return redirect_page(\'NULL\')');
        $form['button_save'] = array('name' => 'action', 'content' => 'Save', 'value' => 'save', 'id' => 'submit', 'type' => 'button', 'class' => 'btn btn-line-parrot');

        return $form;
    } 
    function build_grid_buttons_refill_coupon() {
        $buttons_json = json_encode(array(
	    array(gettext("Create"),"btn btn-line-warning btn","fa fa-plus-circle fa-lg", "button_action", "/refill_coupon/refill_coupon_add/","popup"),
	    array(gettext("Export"),"btn btn-xing" ," fa fa-download fa-lg", "button_action", "/refill_coupon/refill_coupon_export/", 'single'),
           ));
        return $buttons_json;
    }
    function build_user_grid_buttons_refill_coupon() {
        $buttons_json = json_encode(array(
            array("Refresh", "reload", "/refill_coupon/refill_coupon_clearsearchfilter/")));
        return $buttons_json;
    }
    function get_refill_coupon_search_form() {
       $accountinfo=$this->CI->session->userdata('accountinfo');
       $reseller_id=$accountinfo['type']== 1 ?$accountinfo['id'] :  0 ;
        $form['forms'] = array("", array('id' => "refill_coupon_list_search"));
        $form['Search'] = array(
            array('Coupon Number', 'INPUT', array('name' => 'number[number]', '', 'id' => 'number', 'size' => '15', 'class' => "text field "), '', 'tOOL TIP', '1', 'number[number-string]', '', '', '', 'search_string_type', ''),
            array('Description', 'INPUT', array('name' => 'description[description]', '', 'id' => 'description', 'size' => '15','class' => "text field "), '', 'tOOL TIP', '1', 'description[description-string]', '', '', '', 'search_string_type', ''),
            array('Account', 'account_id', 'SELECT', '', '', 'tOOL TIP', 'Please Enter account number', 'id', 'first_name,last_name,number', 'accounts', 'build_concat_dropdown_refill_coupon', 'where_arr', array("reseller_id" => $reseller_id,"type "=>"0", "deleted" => "0")),
            array('Amount', 'INPUT', array('name' => 'amount[amount]', '', 'id' => 'amount', 'size' => '15',  'class' => "text field "), '', 'tOOL TIP', '1', 'amount[amount-integer]', '', '', '', 'search_int_type', ''),
            array('Used?', 'status', 'SELECT', '', '', 'tOOL TIP', 'Please Enter account number', '', '', '', 'set_refill_coupon_status', '', ''),
             
            array('', 'HIDDEN', 'ajax_search', '1', '', '', ''),
            array('', 'HIDDEN', 'advance_search', '1', '', '', ''),
        );
         $form['button_search'] = array('name' => 'action', 'id' => "refill_coupon_search_btn", 'content' => 'Search', 'value' => 'save', 'type' => 'button', 'class' => 'btn btn-line-parrot pull-right');
        $form['button_reset'] = array('name' => 'action', 'id' => "id_reset", 'content' => 'Clear', 'value' => 'cancel', 'type' => 'reset', 'class' => 'btn btn-line-sky pull-right margin-x-10');

        return $form;
    }
    function get_user_refill_coupon_search_form() {

        $form['forms'] = array("", array('id' => "user_refill_coupon_list_search"));
        $form['Search Refill Coupon'] = array(
            array('Coupon Number', 'INPUT', array('name' => 'number[number]', '', 'id' => 'number', 'size' => '15', 'class' => "text field "), '', 'tOOL TIP', '1', 'number[number-string]', '', '', '', 'search_string_type', ''),
            array('Description', 'INPUT', array('name' => 'description[description]', '', 'id' => 'description', 'size' => '15', 'class' => "text field "), '', 'tOOL TIP', '1', 'description[description-string]', '', '', '', 'search_string_type', ''),
            array('Amount', 'INPUT', array('name' => 'amount[amount]', '', 'id' => 'amount', 'size' => '15',  'class' => "text field "), '', 'tOOL TIP', '1', 'amount[amount-integer]', '', '', '', 'search_int_type', ''),
            array('Status', 'status', 'SELECT', '', '', 'tOOL TIP', 'Please Enter account number', '', '', '', 'set_refill_coupon_status', '', ''),
            array('', 'HIDDEN', 'ajax_search', '1', '', '', ''),
            array('', 'HIDDEN', 'advance_search', '1', '', '', ''),
        );
        $form['button_search'] = array('name' => 'action', 'id' => "user_refill_coupon_search_btn", 'content' => 'Search', 'value' => 'save', 'type' => 'button', 'class' => 'ui-state-default float-right ui-corner-all ui-button');
        $form['button_reset'] = array('name' => 'action', 'id' => "id_reset", 'content' => 'Clear Search Filter', 'value' => 'cancel', 'type' => 'reset', 'class' => 'ui-state-default float-right ui-corner-all ui-button');
        return $form;
    }
    function build_refill_coupon_grid() {
		
		$account_info = $accountinfo = $this->CI->session->userdata('accountinfo');
		$currency_id=$account_info['currency_id'];
		$currency=$this->CI->common->get_field_name('currency', 'currency', $currency_id);
		
        $grid_field_arr = json_encode(array(
            array(gettext("Coupon Number"), "150", "number", "", "", "","","true","center"),
            array(gettext("Description"), "165", "description", "", "", "","","true","center"),
            array(gettext("Account"), "165", "account_id", "first_name,last_name,number", "accounts", "build_concat_string","","true","center"),
            array("Amount($currency)", "150", "amount", "amount", "amount", "convert_to_currency","","true","right"),
            array(gettext("Created Date"), "200", "creation_date", "", "", "","","true","center"),
            array(gettext("Used?"),"135","status",'status','status','get_refill_coupon_used',"","true","center"),
            array(gettext("Used Date"), "180", "firstused", "firstused", "firstused", "firstused_check","","true","center"),
            array("Action", "120", "", "", "", array(
                    "DELETE" => array("url" => "refill_coupon/refill_coupon_list_delete/", "mode" => "single")
            ))
                ));
        return $grid_field_arr;
    }
    function build_user_refill_coupon_grid() {
		$account_info = $accountinfo = $this->CI->session->userdata('accountinfo');
         $currency_id=$account_info['currency_id'];
         $currency=$this->CI->common->get_field_name('currency', 'currency', $currency_id);
		 $grid_field_arr = json_encode(array(
            array("Coupon Number", "230", "number", "", "", "","","true","center"),
            array("Description", "210", "description", "", "", "","","true","center"),
            array("Amount($currency)", "190", "amount", "amount", "amount", "convert_to_currency","","true","right"),
            array("Created Date", "250", "creation_date", "", "", "","","true","center"),
            array("Used Date", "250", "firstused", "firstused", "firstused", "firstused_check","","true","center"),
                ));
        return $grid_field_arr;
    }
}
?>
