import 'dart:convert';
import 'package:http/http.dart' as http;
import 'oefening.dart';

class ApiService {
  // Gebruik het juiste IP-adres van je machine
  static const String _baseUrl = 'http://127.0.0.1:8000/api/oefeningen';

  Future<List<Oefening>> fetchOefeningen() async {
    final response = await http.get(Uri.parse(_baseUrl));

    if (response.statusCode == 200) {
      List<dynamic> data = json.decode(response.body);
      return data.map((json) => Oefening.fromJson(json)).toList();
    } else {
      throw Exception('Failed to load oefeningen');
    }
  }
}