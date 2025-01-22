import 'package:flutter/material.dart';
import 'home_screen.dart';
import 'oefenen_screen.dart';  // Voeg de OefenenScreen import toe

void main() {
  runApp(MyApp());
}

class MyApp extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      home: MainScreen(),
    );
  }
}

class MainScreen extends StatelessWidget {
  final List<Widget> _screens = [
    HomeScreen(),
    OefenenScreen(),  // Voeg OefenenScreen toe aan de lijst van schermen
  ];

  @override
  Widget build(BuildContext context) {
    ValueNotifier<int> currentIndex = ValueNotifier<int>(0);

    return ValueListenableBuilder<int>(
      valueListenable: currentIndex,
      builder: (context, index, child) {
        return Scaffold(
          appBar: AppBar(
            title: Text('Game Deals'),
            backgroundColor: Colors.blue,
          ),
          body: _screens[index],
          bottomNavigationBar: BottomNavigationBar(
            currentIndex: index,
            onTap: (int newIndex) {
              if (newIndex == 2) {
                showLicensePage(
                  context: context,
                  applicationName: 'Game Deals App',
                  applicationVersion: '1.0.0',
                  applicationIcon: Icon(Icons.info, color: Colors.blue),
                );
              } else {
                currentIndex.value = newIndex;
              }
            },
            selectedItemColor: Colors.blue,
            unselectedItemColor: Colors.blue.shade200,
            items: const <BottomNavigationBarItem>[
              BottomNavigationBarItem(
                icon: Icon(Icons.home),
                label: 'Home',
              ),
              BottomNavigationBarItem(
                icon: Icon(Icons.school),  // Deze icon kan voor 'Oefenen' worden gebruikt
                label: 'Oefenen',  // Dit label toont Oefenen
              ),
              BottomNavigationBarItem(
                icon: Icon(Icons.info),
                label: 'Licenties',
              ),
            ],
          ),
        );
      },
    );
  }
}
