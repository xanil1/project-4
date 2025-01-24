import 'dart:convert';
import 'package:http/http.dart' as http;
import 'oefening.dart';

class ApiService {
  // Gebruik het juiste IP-adres van je machine
  static const String _baseUrl = 'http://10.0.2.2:8000/api/oefeningen';

  Future<List<Oefening>> fetchOefeningen() async {
    try {
      final response = await http.get(Uri.parse(_baseUrl));

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