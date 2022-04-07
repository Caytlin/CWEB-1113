using System;

namespace Lab4
{
    internal class Program
    {
        static void Main(string[] args)
        {
            Console.WriteLine("The 'If' Statement");
            Console.WriteLine("''''''''''''''''''''''");

            Console.Write("Enter 1st number: ");
            int num1 = Convert.ToInt32(Console.ReadLine());

            Console.Write("Enter 2nd number: ");
            int num2 = Convert.ToInt32(Console.ReadLine());

            Boolean conditionResult = num1 > num2;

            if (num1 == num2)
            {
                Console.WriteLine("\n1st number is equal to 2nd number");
                Console.WriteLine(num1 + " and " + num2 + " are equal");
            }
            else
            {

                if (conditionResult == true)
                {
                    Console.WriteLine("\n1st number is greater than 2nd number");
                    Console.WriteLine(num1 + " is greater than " + num2);
                }

                if (conditionResult == false)
                {
                    Console.WriteLine("\n1st number is lesser than 2nd number");
                    Console.WriteLine(num1 + " Is lesser than " + num2);
                }
            }

            Console.WriteLine("\n..... Thank You! .....");
            Console.ReadKey();
        }
    }
}
