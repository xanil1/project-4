import 'package:flutter/material.dart';
import 'home_screen.dart';
import 'oefenen_screen.dart';
import 'login_screen.dart';

void main() {
  runApp(MyApp());
}

class MyApp extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      home: MainScreen(),  // Startpagina is MainScreen
      routes: {
        '/login': (context) => LoginScreen(),
        '/home': (context) => MainScreen(),  // Zorg ervoor dat '/home' verwijst naar MainScreen
      },
    );
  }
}

class MainScreen extends StatelessWidget {
  final List<Widget> _screens = [
    HomeScreen(),
    OefenenScreen(),
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
            actions: <Widget>[
              IconButton(
                icon: Icon(Icons.login),
                onPressed: () {
                  Navigator.pushNamed(context, '/login');  // Navigeer naar login scherm
                },
              ),
            ],
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
                icon: Icon(Icons.school),
                label: 'Oefenen',
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
