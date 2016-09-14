<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Format_code{
	private $_ci;

	private $_raw_type_data;
	private $_raw_test_data;
	private $_code_commit;
	private $_test_case_count;
	private $_is_debug;

	function __construct()
    {
    	$this->_ci =& get_instance();
    }


    public function get_test_case_count()
    {
    	return $this->_test_case_count;
    }


    //  Trả về function solution()
	public function format_show($lang,$raw_type_data){
		$this->_raw_type_data = $raw_type_data;

		switch ($lang) {
			case 'java':
				return $this->format_show_java();
				break;
			case 'c++':
				return $this->format_show_cpp();
				break;
			case 'python':
				return $this->format_show_python();
				break;
			default:
				# code...
				break;
		}

	}

	private function format_show_c(){

	}
	private function format_show_cpp(){		
		$input_array_type = array("");
    	$output_type = "";
    	$input_template_type = array("int" => "int %s",
						"dynamic_array int" => "vector<int> %s",
						"string" => "string %s");
    	$output_template_type = array("int" => "int solution(%s){ \n \n}",
						"dynamic_array int" => "vector<int> solution(%s){ \n \n}",
						"string"=>"string solution(%s){ \n \n }");
    	$input_variable_name_array = array(0 => "a", 1 => "b", 2 => "c", 3 => "d");

    		   
        $raw_input_output_template_encoded = $this->_raw_type_data->getTemplate();
        $raw_input_output_template_decoded = json_decode($raw_input_output_template_encoded, true);
        
        $input_array_type = $raw_input_output_template_decoded["input"];
        $output_type = $raw_input_output_template_decoded["output"];
        
        $input_part = "";
        foreach ($input_array_type as $key => $value) {
            $variable = $input_variable_name_array[$key];
            $input_part_segment = sprintf($input_template_type[$value], $variable);
            $input_part = $input_part . $input_part_segment . ",";
        }
        $input_part = trim($input_part, ",");
        $output_part = $output_template_type[$output_type];
        $code_return_data = sprintf($output_part, $input_part);
        return $code_return_data;
		
	}
	public function format_show_java(){
		$input_array_type = array("");
    	$output_type = "";
    	$input_template_type = array("int" => "int %s",
						"dynamic_array int" => "List<Integer> %s",
						"string" => "String %s");
    	$output_template_type = array("int" => "public static int solution(%s){ \n \n}",
						"dynamic_array int" => "public static List<Integer> solution(%s){ \n \n}",
						"string" => "public static String solution(%s){ \n \n }");
    	$input_variable_name_array = array(0 => "a", 1 => "b", 2 => "c", 3 => "d");

    		   
        $raw_input_output_template_encoded = $this->_raw_type_data->getTemplate();
        $raw_input_output_template_decoded = json_decode($raw_input_output_template_encoded, true);
        
        $input_array_type = $raw_input_output_template_decoded["input"];
        $output_type = $raw_input_output_template_decoded["output"];
        
        $input_part = "";
        foreach ($input_array_type as $key => $value) {
            $variable = $input_variable_name_array[$key];
            $input_part_segment = sprintf($input_template_type[$value], $variable);
            $input_part = $input_part . $input_part_segment . ",";
        }
        $input_part = trim($input_part, ",");
        $output_part = $output_template_type[$output_type];
        $code_return_data = sprintf($output_part, $input_part);
        return $code_return_data;		
	}
	
	
	private function format_show_python(){
		$input_array_type = array("");
    	$output_type = "";
    	$input_template_type = array("int" => "%s", "dynamic_array int" => "%s","string" => "%s");
    	$output_template_type = array("int" => "def solution(%s):\n\t", "dynamic_array int" => "def solution(%s):\n\t","string"=>"def solution(%s):\n\t");
    	$input_variable_name_array = array(0 => "a", 1 => "b", 2 => "c", 3 => "d");

    		   
        $raw_input_output_template_encoded = $this->_raw_type_data->getTemplate();
        $raw_input_output_template_decoded = json_decode($raw_input_output_template_encoded, true);
        
        $input_array_type = $raw_input_output_template_decoded["input"];
        $output_type = $raw_input_output_template_decoded["output"];
        
        $input_part = "";
        foreach ($input_array_type as $key => $value) {
            $variable = $input_variable_name_array[$key];
            $input_part_segment = sprintf($input_template_type[$value], $variable);
            $input_part = $input_part . $input_part_segment . ",";
        }
        $input_part = trim($input_part, ",");
        $output_part = $output_template_type[$output_type];
        $code_return_data = sprintf($output_part, $input_part);
        return $code_return_data;
		
	}
	private function format_show_cs(){
		
	}


	// Trả về full code test
	public function format_code($lang, $raw_type_data, $raw_test_data, $code_commit,&$test_count,$is_debug){
		$this->_raw_type_data = $raw_type_data;
		$this->_raw_test_data = $raw_test_data;
		$this->_code_commit=$code_commit;
		$this->_is_debug=$is_debug;
		switch ($lang) {
			case 'java':
				return $this->format_code_java($test_count);
				break;
			case 'c++':
				return $this->format_code_cpp($test_count);
				break;
			case 'python':
				return $this->format_code_python($test_count);
				break;
			
			default:
				# code...
				break;
		}

	}
	private function format_code_c(){
		
	}
	private function format_code_cpp(&$test_count){
		$input_array_type = array(0 => "int");
	    $output_type = "int";
    	$input_template_type = array("int" => "int %s",
						"dynamic_array int" => "vector<int> %s",
						"string" => "string %s");
    	$output_template_type = array("int" => "int solution(%s){ \n \n}",
						"dynamic_array int" => "vector<int> solution(%s){ \n \n}",
						"string"=>"string solution(%s){ \n \n }");
	    $input_variable_name_array = array(0 => "a", 1 => "b", 2 => "c", 3 => "d");

    	$full_compile_code_data="";
    	$full_compile_output_result_template=array(
	        "int"=>"vector<int> output_result {%s};",
	        "dynamic_array int" => "vector<vector<int>> output_result {%s};",
			"string"=>"vector<string> output_result {%s};"
        );

    	$full_compile_output_generated_template=array(
	        "int"=>"vector<int> output_generated;",
	        "dynamic_array int" => "vector<vector<int>> output_generated;",
			"string"=>"vector<string> output_generated;"
    	);
    	$full_compile_arg_template=array(
	        "int"=>"vector<int>arg_%s {%s};",
	        "dynamic_array int"=>"vector<vector<int>>arg_%s {%s};",
			"string"=>"vector<string>arg_%s {%s};"
    	);
    	$full_compile_arg_data_template=array(
        	"int"=>"%s,",
        	"dynamic_array int" => "vector<int> {%s},",
			"string"=>"\"%s\","
    	);


    	$arg_inloop_template = "arg_%s[i],";

    	$main_code_template="
		#include <iostream>
#include <cstdlib>
#include <string>
#include <vector>
#include <cmath>
using namespace std;


//code commit
%s

int main(int argc, char* argv[])
{
		//Argmument lines
		%s

		//output_result
		%s
		
		//output_generated
		%s
		
		
		int i = atoi(argv[1])-1;
		
		
		output_generated.push_back(solution(%s));
		
		if (output_result[i]==output_generated[0]){
			cout<<\"\\nACCEPT\";
		}else
		{
			cout<<\"\\nWRONG\";
		}
	
	return 0;
}";
        $raw_input_output_template_encoded = $this->_raw_type_data->getTemplate();
        $raw_input_output_template_decoded = json_decode($raw_input_output_template_encoded, true);

        $input_array_type = $raw_input_output_template_decoded["input"];
        $output_type = $raw_input_output_template_decoded["output"];


        $test_case_input_data=array();
        $test_case_output_data="";

        foreach($input_array_type as $key=> $value){
            $variable = $input_variable_name_array[$key];
            $test_case_input_data[$variable]="";
        }
		
		
		if ($this->_is_debug==1){
			$this->_raw_test_data=array_slice($this->_raw_test_data,0,1);
		}
        foreach ($this->_raw_test_data as $key => $value){
            $raw_test_unit_data_encoded = $value->getData();
            $raw_test_unit_data_decoded = json_decode($raw_test_unit_data_encoded,TRUE);
            $input_array_value=$raw_test_unit_data_decoded["input"];
            foreach($input_array_value as $tmpkey => $tmpvalue)
            {
                $variable= $input_variable_name_array[$tmpkey];
                $variable_type = $input_array_type[$tmpkey];
                if ($variable_type=="dynamic_array int"){                   
                    $tmpvalue = implode($tmpvalue,","); 
                };
                $test_case_input_data[$variable]=$test_case_input_data[$variable].sprintf($full_compile_arg_data_template[$variable_type],$tmpvalue);

            }

            $output_value=$raw_test_unit_data_decoded["output"];
            if ($output_type=="dynamic_array int"){                   
                    $output_value = implode($output_value,","); 
            };
            $test_case_output_data=$test_case_output_data.sprintf($full_compile_arg_data_template[$output_type],$output_value);

        }

        foreach ($test_case_input_data as $key=>$value){
        $test_case_input_data[$key]=rtrim ($test_case_input_data[$key],",");
        }

        $test_case_output_data=rtrim($test_case_output_data,",");


        $output_result_part="";
        $output_result_part=sprintf($full_compile_output_result_template[$output_type],$test_case_output_data);

        $output_generated_part="";
        $output_generated_part=$full_compile_output_generated_template[$output_type];

        $test_case_count=count($this->_raw_test_data);
        $test_count=$test_case_count;

        $argument_lines_part="";
        foreach($input_array_type as $key=>$value){
            $arg_line="";
            $arg_variable = $input_variable_name_array[$key];
            $arg_line = sprintf($full_compile_arg_template[$value],$arg_variable,$test_case_input_data[$arg_variable]);
            $argument_lines_part = $argument_lines_part.$arg_line."\n";
        }


        $in_loop_arg_part="";
        foreach($input_array_type as $key => $value){
            $in_loop_unit = "";
            $in_loop_variable=$input_variable_name_array[$key];
            $in_loop_unit=sprintf($arg_inloop_template,$in_loop_variable);
            $in_loop_arg_part=$in_loop_arg_part.$in_loop_unit;
        }
        $in_loop_arg_part=rtrim($in_loop_arg_part,",");

        $full_compile_code_data=sprintf($main_code_template,		
            $this->_code_commit,
            $argument_lines_part,
            $output_result_part,
            $output_generated_part,
            $in_loop_arg_part);

        return $full_compile_code_data;			
		
		
	}
	private function format_code_java(&$test_count){
		$input_array_type = array(0 => "int");
	    $output_type = "int";
	    $input_template_type = array(
	    	"int" => "int %s",
	    	"dynamic_array int" => "List<Integer> %s",
			"string" => "String %s");
	    $output_template_type = array(
	    	"int" => "public static int solution(%s){ \n \n }", 
	    	"dynamic_array int" => "public static List<Integer> solution(%s){ \n \n}",
			"string" => "public static String solution(%s){ \n \n}");
	    $input_variable_name_array = array(0 => "a", 1 => "b", 2 => "c", 3 => "d");

    	$full_compile_code_data="";
    	$full_compile_output_result_template=array(
	        "int"=>"List<Integer> output_result = Arrays.asList(%s);",
	        "dynamic_array int" => "List<List<Integer>> output_result = Arrays.asList(%s);",
			"string"=>"List<String> output_result = Arrays.asList(%s);"
        );

    	$full_compile_output_generated_template=array(
	        "int"=>"List<Integer> output_generated = new ArrayList<Integer>();",
	        "dynamic_array int" => "List<List<Integer>> output_generated = new ArrayList<List<Integer>>();",
			"string"=>"List<String> output_generated = new ArrayList<String>();"
    	);
    	$full_compile_arg_template=array(
	        "int"=>"List<Integer>arg_%s = Arrays.asList(%s);",
	        "dynamic_array int"=>"List<List<Integer>>arg_%s = Arrays.asList(%s);",
			"string"=>"List<String>arg_%s = Arrays.asList(%s);"
    	);
    	$full_compile_arg_data_template=array(
        	"int"=>"%s,",
        	"dynamic_array int" => "Arrays.asList(%s),",
			"string"=>"\"%s\","
    	);


    	$number_test_template = "int number_test = %d;";

    	$arg_inloop_template = "arg_%s.get(i),";

    	$main_code_template="
import java.util.ArrayList;
import java.util.Arrays;
import java.util.List;
class Tester {
    public static void main(String[] args) {

        //Argmument lines 
        %s
        //output_result
        %s
        //output_generated
        %s
        //number test
        %s        
        int i = Integer.valueOf(args[0])-1;
        output_generated.add(solution(%s));
        if (output_result.get(i).equals(output_generated.get(0))){
            System.out.println(\"ACCEPT\");
        }else{
            System.out.println(\"WRONG\");
        }
    }
    //code_commit
    %s


}";
        $raw_input_output_template_encoded = $this->_raw_type_data->getTemplate();
        $raw_input_output_template_decoded = json_decode($raw_input_output_template_encoded, true);

        $input_array_type = $raw_input_output_template_decoded["input"];
        $output_type = $raw_input_output_template_decoded["output"];


        $test_case_input_data=array();
        $test_case_output_data="";

        foreach($input_array_type as $key=> $value){
            $variable = $input_variable_name_array[$key];
            $test_case_input_data[$variable]="";
        }
		
		
		if ($this->_is_debug==1){
			$this->_raw_test_data=array_slice($this->_raw_test_data,0,1);
		}
        foreach ($this->_raw_test_data as $key => $value){
            $raw_test_unit_data_encoded = $value->getData();
            $raw_test_unit_data_decoded = json_decode($raw_test_unit_data_encoded,TRUE);
            $input_array_value=$raw_test_unit_data_decoded["input"];
            foreach($input_array_value as $tmpkey => $tmpvalue)
            {
                $variable= $input_variable_name_array[$tmpkey];
                $variable_type = $input_array_type[$tmpkey];
                if ($variable_type=="dynamic_array int"){                   
                    $tmpvalue = implode($tmpvalue,","); 
                };
                $test_case_input_data[$variable]=$test_case_input_data[$variable].sprintf($full_compile_arg_data_template[$variable_type],$tmpvalue);

            }

            $output_value=$raw_test_unit_data_decoded["output"];
            if ($output_type=="dynamic_array int"){                   
                    $output_value = implode($output_value,","); 
            };
            $test_case_output_data=$test_case_output_data.sprintf($full_compile_arg_data_template[$output_type],$output_value);

        }

        foreach ($test_case_input_data as $key=>$value){
        $test_case_input_data[$key]=rtrim ($test_case_input_data[$key],",");
        }

        $test_case_output_data=rtrim($test_case_output_data,",");


        $output_result_part="";
        $output_result_part=sprintf($full_compile_output_result_template[$output_type],$test_case_output_data);

        $output_generated_part="";
        $output_generated_part=$full_compile_output_generated_template[$output_type];

        $test_case_count=count($this->_raw_test_data);
        $test_count=$test_case_count;
        $number_test_part=sprintf($number_test_template,$test_case_count);

        $argument_lines_part="";
        foreach($input_array_type as $key=>$value){
            $arg_line="";
            $arg_variable = $input_variable_name_array[$key];
            $arg_line = sprintf($full_compile_arg_template[$value],$arg_variable,$test_case_input_data[$arg_variable]);
            $argument_lines_part = $argument_lines_part.$arg_line."\n";
        }


        $in_loop_arg_part="";
        foreach($input_array_type as $key => $value){
            $in_loop_unit = "";
            $in_loop_variable=$input_variable_name_array[$key];
            $in_loop_unit=sprintf($arg_inloop_template,$in_loop_variable);
            $in_loop_arg_part=$in_loop_arg_part.$in_loop_unit;
        }
        $in_loop_arg_part=rtrim($in_loop_arg_part,",");

        $full_compile_code_data=sprintf($main_code_template,
            $argument_lines_part,
            $output_result_part,
            $output_generated_part,
            $number_test_part,
            $in_loop_arg_part,
            $this->_code_commit);

        return $full_compile_code_data;			
	}
	private function format_code_python(&$test_count){		
		
		$input_array_type = array();
	    $output_type = "";
	    $input_template_type = array(
	    	"int" => "%s",
	    	"dynamic_array int" => "%s",
			"string"=>"%s");
	    $output_template_type = array(
	    	"int" => "def solution(%s)\n", 
	    	"dynamic_array int" => "def solution(%s)\n",
			"string" => "def solution(%s)\n");
	    $input_variable_name_array = array(0 => "a", 1 => "b", 2 => "c", 3 => "d");

    	$full_compile_code_data="";
    	$full_compile_output_result_template=array(
	        "int"=>"output_result =[%s]",
	        "dynamic_array int" => "output_result = [%s];",
			"string"=>"output_result =[%s]"
        );

    	$full_compile_output_generated_template=array(
	        "int"=>"output_generated=[]",
	        "dynamic_array int" => "output_generated=[]",
			"string"=>"output_generated=[]"
    	);
    	$full_compile_arg_template=array(
	        "int"=>"arg_%s =[%s]",
	        "dynamic_array int"=>"arg_%s =[%s]",
			"string"=>"arg_%s =[%s]"
    	);
    	$full_compile_arg_data_template=array(
        	"int"=>"%s,",
        	"dynamic_array int" => "[%s],",
			"string"=>"\"%s\","
    	);


    	$arg_inloop_template = "arg_%s[i],";

    	$main_code_template="
import sys
#code commit go here
%s
	pass
#argument lines go here
%s

#output result go here
%s

#output generated go here
%s

i=int(sys.argv[1])-1

output_generated.append(solution(%s))
if output_result[i]==output_generated[0]:
    print \"ACCEPT\"
else:
    print \"WRONG\"

";
        $raw_input_output_template_encoded = $this->_raw_type_data->getTemplate();
        $raw_input_output_template_decoded = json_decode($raw_input_output_template_encoded, true);

        $input_array_type = $raw_input_output_template_decoded["input"];
        $output_type = $raw_input_output_template_decoded["output"];


        $test_case_input_data=array();
        $test_case_output_data="";

        foreach($input_array_type as $key=> $value){
            $variable = $input_variable_name_array[$key];
            $test_case_input_data[$variable]="";
        }
		
		
		if ($this->_is_debug==1){
			$this->_raw_test_data=array_slice($this->_raw_test_data,0,1);
		}
        foreach ($this->_raw_test_data as $key => $value){
            $raw_test_unit_data_encoded = $value->getData();
            $raw_test_unit_data_decoded = json_decode($raw_test_unit_data_encoded,TRUE);
            $input_array_value=$raw_test_unit_data_decoded["input"];
            foreach($input_array_value as $tmpkey => $tmpvalue)
            {
                $variable= $input_variable_name_array[$tmpkey];
                $variable_type = $input_array_type[$tmpkey];
                if ($variable_type=="dynamic_array int"){                   
                    $tmpvalue = implode($tmpvalue,","); 
                };
                $test_case_input_data[$variable]=$test_case_input_data[$variable].sprintf($full_compile_arg_data_template[$variable_type],$tmpvalue);

            }

            $output_value=$raw_test_unit_data_decoded["output"];
            if ($output_type=="dynamic_array int"){                   
                    $output_value = implode($output_value,","); 
            };
            $test_case_output_data=$test_case_output_data.sprintf($full_compile_arg_data_template[$output_type],$output_value);

        }

        foreach ($test_case_input_data as $key=>$value){
        $test_case_input_data[$key]=rtrim ($test_case_input_data[$key],",");
        }

        $test_case_output_data=rtrim($test_case_output_data,",");


        $output_result_part="";
        $output_result_part=sprintf($full_compile_output_result_template[$output_type],$test_case_output_data);

        $output_generated_part="";
        $output_generated_part=$full_compile_output_generated_template[$output_type];

        $test_case_count=count($this->_raw_test_data);
        $test_count=$test_case_count;

        $argument_lines_part="";
        foreach($input_array_type as $key=>$value){
            $arg_line="";
            $arg_variable = $input_variable_name_array[$key];
            $arg_line = sprintf($full_compile_arg_template[$value],$arg_variable,$test_case_input_data[$arg_variable]);
            $argument_lines_part = $argument_lines_part.$arg_line."\n";
        }


        $in_loop_arg_part="";
        foreach($input_array_type as $key => $value){
            $in_loop_unit = "";
            $in_loop_variable=$input_variable_name_array[$key];
            $in_loop_unit=sprintf($arg_inloop_template,$in_loop_variable);
            $in_loop_arg_part=$in_loop_arg_part.$in_loop_unit;
        }
        $in_loop_arg_part=rtrim($in_loop_arg_part,",");

        $full_compile_code_data=sprintf($main_code_template,		
            $this->_code_commit,
            $argument_lines_part,
            $output_result_part,
            $output_generated_part,
            $in_loop_arg_part);

        return $full_compile_code_data;			
		
		
		
	}
	private function format_code_cs(){
		
	}
}