#include <cs50.h>
#include <stdio.h>
#include <math.h>

int main (void)
{
	
	int quarter = 25;
	int dime = 10;
	int nickel = 5;
	int penny = 1;
	int total_coins = 0;
	float change;
	int change_to_int;
	
	do
	{
	printf("How much change do I owe you? ");
	change = GetFloat();
	change_to_int = 0;
	change_to_int = ((int)round(change * 100));
	
	}

	while (change_to_int <= 0);
	
	
	while (change_to_int >= quarter) {
		change_to_int = (change_to_int - quarter);
		total_coins++;
	}
	
	while (change_to_int >= dime) {
		change_to_int = (change_to_int - dime);
		total_coins++;
	}
	
	while (change_to_int >= nickel) {
		change_to_int = (change_to_int - nickel);
		total_coins++;
	}
	
	while (change_to_int >= penny) {
		change_to_int = (change_to_int - penny);
		total_coins++;
	}
	
	printf("%d\n", total_coins);

    
}