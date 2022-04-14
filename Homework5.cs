using System;

namespace Homework5
{
    internal class Program
    {
        static void WhileMethod()
        {
            Console.WriteLine("WHILE LOOP");
            Console.WriteLine("''''''''''''");

            Console.WriteLine("INPUT:");
            Console.Write("Enter a number to start: ");
            int num1 = Convert.ToInt32(Console.ReadLine());
            Console.Write("Enter a number to end: ");
            int num2 = Convert.ToInt32(Console.ReadLine());
            Console.WriteLine("''''''''''''''''''''''''''''''''''''''''''''");

            int incrementNumber = num1;
            Console.WriteLine("OUTPUT:");

            while (incrementNumber <= num2)
            {
                Console.WriteLine("WHILE LOOP BLOCK STARTS with value: " + incrementNumber);
                incrementNumber++;
                Console.WriteLine("Value after increment: " + incrementNumber);
                Console.WriteLine("..WHILE LOOP BLOCK ENDS\n");
            }

            Console.WriteLine("''''''''''''''''''''''''''''''''''''''''''''");
            Console.WriteLine("*** Thank You ***");
        }
        
        static void DoWhileMethod()
        {
            Console.WriteLine("DO WHILE LOOP");
            Console.WriteLine("'''''''''''''''");

            Console.WriteLine("INPUT:");
            Console.Write("Enter a number to start: ");
            int num1 = Convert.ToInt32(Console.ReadLine());
            Console.Write("Enter a number to end: ");
            int num2 = Convert.ToInt32(Console.ReadLine());
            Console.WriteLine("''''''''''''''''''''''''''''''''''''''''''''");

            int incrementNumber = num1;
            Console.WriteLine("OUTPUT:");

            do
            {
                Console.WriteLine("DO-WHILE LOOP BLOCK STARTS with value: " + incrementNumber);
                incrementNumber++;
                Console.WriteLine("Value after increment: " + incrementNumber);
                Console.WriteLine("..DO-WHILE LOOP BLOCK ENDS\n");
            }
            while (incrementNumber <= num2);

            Console.WriteLine("''''''''''''''''''''''''''''''''''''''''''''");
            Console.WriteLine("*** Thank You ***\n");
        }

        static void Main(string[] args)
        {
            WhileMethod();
            Console.WriteLine("###################################\n");
            DoWhileMethod();
        }
    }
}
