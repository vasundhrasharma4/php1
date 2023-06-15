<!--  5.  Html for creating form-->
<html>
    <body>
        <!-- Css for styling forms-->
        <style>
            h1{
                color: white;
            }
            body
            {
                background-color: pink;
            }
            #domestic-call,#international-call,#international-text,#over-data{
                width:300px;
                height:40px;
                margin-bottom:40px;
            }
        </style>
    

    <form action="" method="POST">

          <h1>Yumanzi Corporation - Calculate Telephone Bill</h1>
          <input type="text" id="domestic-call" placeholder=" please enter no. of domestic calls"  name="domestic"><br>
          <input type="text" id="international-call" placeholder=" please enter no. of international calls" name="internationalC" ><br>
          <input type="text" id="international-text" placeholder=" please enter no. of international text." name="internationlT" ><br>
          <input type="text" id="over-data" placeholder=" please enter over data usage in mb." name="over" required><br>
          <input type="Submit" name="submit">

</form>
    </body>
</html>

<!--from here php starts-->
<?php
# if user will click submit button then this codw will work

    if(isset($_POST['submit'])){
# 8. creating exception by using try-catch-finally
        try{
            #here we are trying if values in input are storing in these variables 
            $domesticCall=$_POST['domestic'];
            $internationalCall=$_POST['internationalC'];
            $internationalText=$_POST['internationlT'];
            $overData=$_POST['over'];
            
            # everything is right then print this stattement
            echo "try statement works <br>";
          }
# if there is any exception catch statement works
        catch (Exception $e) {
            echo "some issues";
        }
        # this statement will work either of try or catch statement works
        finally {
            echo "try-catch-finally statement works <br> ";
        }

# if any field is empty then this error will display as fatal error 
        if (empty($domesticCall) || empty($internationalCall) ||  empty($internationalText) || empty($overData)) {
            throw new Exception("Please fill all values.");
        }

# every input should be natural number here we can use it for any input value such as $internationalCall, $internationalText
        if ($domesticCall<0)
        {
            throw new Exception("number should be natural number");
        }

        # 3. For every domestic call: $0.05 per call (fixed)
             $domesticPrice =0.5 * $domesticCall;

        #for international calls
                #first five calls are free so price will be zero
                if ($internationalCall>=0 & $internationalCall<6)
                {
                    $internationalPrice=0* $internationalCall ;
                }
                # — From 6 to 10 calls: $5 per each call
                elseif ($internationalCall>=6 & $internationalCall<11)
                {
                    $internationalPrice= 5*($internationalCall-5);
                }
                #— For 11 to 20 calls: $7 per each call
                elseif ($internationalCall>=11 & $internationalCall<21) 
                {
                    $internationalPrice= 7*($internationalCall-10)+ 5*5;
                }
                #— More than 20 calls: $8 per call
                else
                {
                    $internationalPrice= 8*($internationalCall-20)+ 5 * 5 + 10 * 7;
                }
                
            #domestic tecting is free so it will not matter in bill.
            #  International texts: $0.50 per text
                $internationalTextPrice = 0.5 * $internationalText;
    
             #over data in mb only, 1gb=1024 mb so 8gb =8194
             #Over data usage: $0.05 per MB OR $50 per GB
                if ($overData>8192)
                {
                    $overdataPrice= 40+ 0.05 * ($overData-8192);
                }
                #Internet Plan of 8 GB is $40 (fixed).
                else
                {
                    $overdataPrice=40;
                }

                # 7. creating function to calculate total bill
                #passing four arguments for prices that affect bill
                function Yumanzi_calculate($domesticPrice,$internationalPrice,$internationalTextPrice,$overdataPrice){
                    # total of bill without tax
                    $billTotal= $domesticPrice+$internationalPrice+$internationalTextPrice+$overdataPrice;
                    #6.  applying 9% tax on it.
                    $taxBill= 0.09*$billTotal+$billTotal;

                    #printing total of bill without tax and after tax.
                    echo "total bill without taxes is:-".$billTotal."<br>";
                    echo "<b> total bill after tax is:- ".$taxBill."</b> <br>";
    
                
                }
                
                    
              # printing all input values
                echo " No of domestic call are:-   ".$domesticCall."<br>"."price of domestic call is:-  ".$domesticPrice."<br>";
                echo " No of International call are:-   ".$internationalCall."<br>"."price of international call is:-   ".$internationalPrice."<br>";
                echo " No  of International text are :-  ".$internationalText."<br>"."price of international text is:-   ".$internationalTextPrice."<br>";
                echo "over data usage is :-  ".$overData."<br>"."price of over data is:-   ".$overdataPrice."<br>";
             # calling function to print bill
                Yumanzi_calculate($domesticPrice,$internationalPrice,$internationalTextPrice,$overdataPrice);


             
                

}

?>