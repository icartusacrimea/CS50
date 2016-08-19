#include <cs50.h>
#include <stdio.h>

int main (void)
{
    printf("Enter the length of your shower in minutes: ");
    int minutes = GetInt();
    int bottles = minutes * 12;
    
    printf("Your shower uses %i bottles of water! Are you ashamed of yourself?\n", bottles);
}