<?php
/**
 * Created by PhpStorm.
 * User: ByoungOk
 * Date: 2018-02-09
 * Time: 오후 2:09
 */

class keyboard {



    function createTable(){
        $notesOf30 = array(E3,D3,C3,B2,A2S,A2,G2S,G2,F2S,F2,E2,D2S,D2,C2S,C2,B1,A1S,A1,G1S,G1,F1S,F1,E1,D1,C1,B0,A0,G0,D0,C0);
        $nameOfNotesOf30 = array('E<sub>3</sub>','D<sub>3</sub>','C<sub>3</sub>','B<sub>2</sub>','A<sub>2</sub></sub><sup>#</sup>','A<sub>2</sub>','G<sub>2</sub></sub><sup>#</sup>','G<sub>2</sub>','F<sub>2</sub></sub><sup>#</sup>','F<sub>2</sub>','E<sub>2</sub>','D<sub>2</sub></sub><sup>#</sup>','D<sub>2</sub>','C<sub>2</sub></sub><sup>#</sup>','C<sub>2</sub>','B<sub>1','A<sub>1</sub><sup>#</sup>','A<sub>1','G<sub>1</sub><sup>#</sup>','G<sub>1','F<sub>1</sub><sup>#</sup>','F<sub>1','E<sub>1','D<sub>1','C<sub>1','B<sub>0</sub>','A<sub>0</sub>','G<sub>0</sub>','D<sub>0</sub>','C<sub>0</sub>');
            foreach ($nameOfNotesOf30 as $key => $value){

                echo "<tr><th id='$notesOf30[$key]'>
                      $value
                      </th></tr>";
            }


    }
}


define('C0',40);
define('C0S',41);
define('D0',42);
define('D0S',43);
define('E0',44);
define('F0',45);
define('F0S',46);
define('G0',47);
define('G0S',48);
define('A0',49);
define('A0S',50);
define('B0',51);
//--------------
define('C1',52);
define('C1S',53);
define('D1',54);
define('D1S',55);
define('E1',56);
define('F1',57);
define('F1S',58);
define('G1',59);
define('G1S',60);
define('A1',61);
define('A1S',62);
define('B1',63);
//---------------
define('C2',64);
define('C2S',65);
define('D2',66);
define('D2S',67);
define('E2',68);
define('F2',69);
define('F2S',70);
define('G2',71);
define('G2S',72);
define('A2',73);
define('A2S',74);
define('B2',75);
//---------------
define('C3',76);
define('C3S',77);
define('D3',78);
define('D3S',79);
define('E3',80);
define('F3',81);
define('F3S',82);
define('G3',83);
define('G3S',84);
define('A3',85);
define('A3S',86);
define('B3',87);
//--------------
define('C4',88);

