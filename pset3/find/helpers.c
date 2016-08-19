/**
 * helpers.c
 *
 * Computer Science 50
 * Problem Set 3
 *
 * Helper functions for Problem Set 3.
 */
       

#include "helpers.h"

/**
 * Returns true if value is in array of n values, else false.
 */
bool search(int value, int values[], int n)
{
    if (n < 1)
    {
        return false;
    }
    
    sort(values, n);
    
    int min = 0;
    int max = n - 1;
    
    while (max >= min)
    {
        int midpoint = (min + max)/2;
        
        if (max == min)
        {
            if (value == values[n-1])
                return true;
        }
        if (value == values[midpoint])
        {
            return true;
        }
        else if (value < values[midpoint])
        {
            max = midpoint - 1;
        }
        else
        {
            min = midpoint + 1;
        }
    }
    
    return false;
        
    }

/**
 * Sorts array of n values.
 */
void sort(int values[], int n)
{
    // TODO: implement an O(n^2) sorting algorithm
    int i, key, j;
    for (i = 1; i < n; i++)
    {
        key = values[i];
        j = i - 1;
        while (j >= 0 && values[j] > key)
        {
            values[j + 1] = values[j];
            j = j - 1;
            values[j + 1] = key;
        }
    }
    
}