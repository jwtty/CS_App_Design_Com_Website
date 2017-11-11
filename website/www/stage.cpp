#include<cstdio>
#include<iostream>
#include<fstream>
using namespace std;
int main()
{
		string str = "";
		while (true)
		{
				cout << "Select stage:\n1. Submission\n 2.Evaluation\n 3.Finish\n";
				char ch = getchar();
				if (ch == '1')
					str = "submit\n";
			else if (ch == '2')
					str = "evaluation\n";
			else if (ch == '3')
					str = "finish\n";
			else
					continue;
			break;
		}
		ofstream ofs;
		ofs.open("/var/www/stage.txt", ofstream::out|ofstream::trunc);
		ofs << str;
		ofs.close();
		return 0;
}
