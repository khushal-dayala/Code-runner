<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $programs = [
            [
                'title' => 'Hello World',
                'code' => 'echo "Hello, World!";',
                'category_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'title' => 'Simple Calculator',
                'code' => '$num1 = 10; $num2 = 5; echo "Addition: " . ($num1 + $num2) . "\n"; echo "Subtraction: " . ($num1 - $num2);',
                'category_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'title' => 'Check Even or Odd',
                'code' => '$number = 7; echo ($number % 2 == 0) ? "$number is Even" : "$number is Odd";',
                'category_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'title' => 'Factorial of a Number',
                'code' => 'function factorial($n) { return ($n == 0) ? 1 : $n * factorial($n - 1); } echo factorial(5);',
                'category_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'title' => 'Reverse a String',
                'code' => '$str = "Hello"; echo strrev($str);',
                'category_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'title' => 'Check Prime Number',
                'code' => '$num = 29; $isPrime = true; for ($i = 2; $i <= sqrt($num); $i++) { if ($num % $i == 0) { $isPrime = false; break; } } echo $isPrime ? "$num is Prime" : "$num is not Prime";',
                'category_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'title' => 'Generate Fibonacci Sequence',
                'code' => '$n = 10; $a = 0; $b = 1; echo "$a $b "; for ($i = 2; $i < $n; $i++) { $c = $a + $b; echo "$c "; $a = $b; $b = $c; }',
                'category_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'title' => 'Convert Celsius to Fahrenheit',
                'code' => '$celsius = 25; $fahrenheit = ($celsius * 9/5) + 32; echo "$celsius°C is equal to $fahrenheit°F";',
                'category_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'title' => 'Palindrome Check',
                'code' => '$str = "radar"; echo ($str == strrev($str)) ? "$str is a Palindrome" : "$str is not a Palindrome";',
                'category_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'title' => 'Sum of Digits',
                'code' => '$num = 123; $sum = array_sum(str_split($num)); echo "Sum of digits of $num is $sum";',
                'category_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'title' => 'Find Maximum of Three Numbers',
                'code' => '$a = 10; $b = 20; $c = 15; echo "Maximum is " . max($a, $b, $c);',
                'category_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'title' => 'Calculate Power of a Number',
                'code' => '$base = 2; $exp = 3; echo "$base raised to the power $exp is " . pow($base, $exp);',
                'category_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'title' => 'Sort an Array',
                'code' => '$arr = [4, 2, 8, 1]; sort($arr); echo "Sorted array: " . implode(", ", $arr);',
                'category_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'title' => 'Count Vowels in a String',
                'code' => '$str = "Hello World"; $vowels = preg_match_all("/[aeiouAEIOU]/", $str); echo "Number of vowels in \'$str\' is $vowels";',
                'category_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'title' => 'Check Leap Year',
                'code' => '$year = 2024; echo ($year % 4 == 0 && ($year % 100 != 0 || $year % 400 == 0)) ? "$year is a Leap Year" : "$year is not a Leap Year";',
                'category_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];

        DB::table('codes')->insert($programs);
    }
}
