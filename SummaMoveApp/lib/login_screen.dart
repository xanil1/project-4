import 'package:http/http.dart' as http;
import 'package:flutter/material.dart';
import 'dart:convert'; // Om JSON te kunnen decoderen

class LoginScreen extends StatefulWidget {
  @override
  _LoginScreenState createState() => _LoginScreenState();
}

class _LoginScreenState extends State<LoginScreen> {
  final TextEditingController emailController = TextEditingController();
  final TextEditingController passwordController = TextEditingController();
  ValueNotifier<bool> isLoggedIn = ValueNotifier<bool>(false);
  String username = "";

  Future<void> login(BuildContext context) async {
    try {
      final response = await http.post(
        Uri.parse('http://10.0.2.2:8000/api/login'),
        body: {
          'email': emailController.text,
          'password': passwordController.text,
        },
        headers: {
          'Accept': 'application/json',
        },
      );

      if (response.statusCode == 200) {
        var data = jsonDecode(response.body);
        String token = data['token'];
        username = data['user']['name'];

        setState(() {
          isLoggedIn.value = true;
        });

        // Bewaar het token bijvoorbeeld in SecureStorage
        // Sla de gebruikersnaam op voor later gebruik

        // Verplaats naar MainScreen (behoud de app-structuur)
        Navigator.pushReplacementNamed(context, '/home');
      } else {
        print('Login mislukt');
      }
    } catch (e) {
      print('Fout bij login: $e');
    }
  }

  Future<void> logout() async {
    setState(() {
      isLoggedIn.value = false;
      username = "";
    });
    Navigator.pushNamed(context, '/login');
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: isLoggedIn.value
            ? GestureDetector(
          onTap: () => showDialog(
            context: context,
            builder: (context) => AlertDialog(
              title: Text("Afmelden"),
              content: Text("Weet je zeker dat je wilt afmelden?"),
              actions: <Widget>[
                TextButton(
                  child: Text('Annuleren'),
                  onPressed: () => Navigator.of(context).pop(),
                ),
                TextButton(
                  child: Text('Afmelden'),
                  onPressed: () {
                    logout();
                    Navigator.of(context).pop();
                  },
                ),
              ],
            ),
          ),
          child: Text(username),
        )
            : Text('Login'),
        backgroundColor: Colors.blue,
      ),
      body: Padding(
        padding: const EdgeInsets.all(16.0),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: <Widget>[
            if (!isLoggedIn.value) ...[
              TextField(
                controller: emailController,
                decoration: InputDecoration(labelText: 'Email'),
              ),
              TextField(
                controller: passwordController,
                obscureText: true,
                decoration: InputDecoration(labelText: 'Password'),
              ),
              SizedBox(height: 20),
              ElevatedButton(
                onPressed: () {
                  // Roep login aan wanneer de knop wordt ingedrukt
                  login(context);
                },
                child: Text('Login'),
              ),
            ]
          ],
        ),
      ),
    );
  }
}