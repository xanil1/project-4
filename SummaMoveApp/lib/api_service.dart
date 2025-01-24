import 'dart:convert';
import 'package:http/http.dart' as http;
import 'oefening.dart';

class ApiService {
  // Gebruik het juiste IP-adres van je machine
  static const String _baseUrl = 'http://10.0.2.2:8000/api';

  // Functie om in te loggen
  Future<String?> login(String email, String password) async {
    final url = Uri.parse('$_baseUrl/login'); // Zorg ervoor dat je API een login-endpoint heeft

    try {
      final response = await http.post(
        url,
        headers: {'Content-Type': 'application/json'},
        body: json.encode({
          'email': email,
          'password': password,
        }),
      );

      print('Response status: ${response.statusCode}');
      print('Response body: ${response.body}');

      if (response.statusCode == 200) {
        final data = json.decode(response.body);
        // Hier halen we de username op uit de response van je API
        return data['username']; // Zorg ervoor dat de API een 'username' veld bevat
      } else {
        print('Login failed: ${response.statusCode}');
        throw Exception('Failed to login');
      }
    } catch (e) {
      print('Error during login: $e');
      rethrow; // Gooi de fout opnieuw zodat deze in de UI zichtbaar blijft
    }
  }

  // Functie om oefeningen op te halen
  Future<List<Oefening>> fetchOefeningen() async {
    try {
      final response = await http.get(Uri.parse('$_baseUrl/oefeningen'));

      print('Response status: ${response.statusCode}');
      print('Response body: ${response.body}');

      if (response.statusCode == 200) {
        List<dynamic> data = json.decode(response.body);
        return data.map((json) => Oefening.fromJson(json)).toList();
      } else {
        print('Failed to load oefeningen: ${response.statusCode}');
        throw Exception('Failed to load oefeningen');
      }
    } catch (e) {
      print('Error fetching oefeningen: $e');
      rethrow; // Gooi de fout opnieuw zodat deze in de UI zichtbaar blijft
    }
  }
}