using System;

namespace Lab2
{
    internal class Program
    {
        static void Main(string[] args)
        {
            Console.Write("Enter the number to test = ");
            int userNum1 = Convert.ToInt32(Console.ReadLine());

            Console.Write("Enter the number you want to multiply " + userNum1 + " with: ");
            int userNum2 = Convert.ToInt32(Console.ReadLine());

            int result = userNum1 * userNum2;

            Console.WriteLine("\nUsing Multiplication Assignment Operator...\nUpdated value of your test number = " + result);
            Console.ReadKey();
        }
    }
}
