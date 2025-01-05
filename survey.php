<?php
// include('sql_statements.php');

 $survey=select_info_multiple_key("select * from survey");
 if($survey)
 {
     echo "
     <input type=hidden name=user value=$session_id />
     <table border=1 cellspacing=10 cellpadding=10>
        <thead>
            <tr>
                 <th>Question</th>
                 <th>5</th>
                 <th>4</th>
                 <th>3</th>
                 <th>2</th>
                 <th>1</th>
            </tr>
        </thead>";
     foreach($survey as $s)
     {
        echo "<tr>
             <td>".$s['question']."</td>
             <td><input onclick=validate(this.form);  type=radio name=q".$s['id_question']." value=5 /></td>
             <td><input onclick=validate(this.form);  type=radio name=q".$s['id_question']." value=4 /></td>
             <td><input onclick=validate(this.form);  type=radio name=q".$s['id_question']." value=3 /></td>
             <td><input onclick=validate(this.form);  type=radio name=q".$s['id_question']." value=2 /></td>
             <td><input onclick=validate(this.form);  type=radio name=q".$s['id_question']." value=1 /></td>


        </tr>";
     }
     echo "
     <tr>
          <th colspan=6 align=right>
            <input type=submit id=but value=Save disabled='disabled'  />

          </th>
     </tr>
     </table>

     ";
 }
?>

<script>
    function validate(f)
    {
        if(f.q1.value>=1 && f.q2.value>=1 && f.q3.value>=1 && f.q4.value>=1 && f.q5.value>=1 && f.q6.value>=1 && f.q7.value>=1 &&  f.q8.value>=1 && f.q9.value>=1 && f.q10.value>=1  && f.q11.value>=1 && f.q12.value>=1 && f.q13.value>=1 && f.q14.value>=1 && f.q15.value>=1  && f.q16.value>=1 && f.q17.value>=1 && f.q18.value>=1 && f.q19.value>=1 && f.q20.value>=1  && f.q21.value>=1 && f.q22.value>=1 && f.q23.value>=1 && f.q24.value>=1 && f.q25.value>=1  && f.q26.value>=1 && f.q27.value>=1 && f.q28.value>=1 && f.q29.value>=1 && f.q30.value>=1)
        {
          document.getElementById('but').disabled="";
        }
        else
        {
           document.getElementById('but').disabled="disabled";
        }

    }
</script>
