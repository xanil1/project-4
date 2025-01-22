// oefening_detail_screen.dart
import 'package:flutter/material.dart';
import 'oefening.dart';

class OefeningDetailScreen extends StatelessWidget {
  final Oefening oefening;

  OefeningDetailScreen({required this.oefening});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text(oefening.name),
      ),
      body: Padding(
        padding: const EdgeInsets.all(16.0),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            // Toon de afbeelding
            Image.network(oefening.image),
            SizedBox(height: 16),
            Text(
              oefening.name,
              style: TextStyle(fontSize: 24, fontWeight: FontWeight.bold),
            ),
            SizedBox(height: 8),
            Text(
              oefening.description,
              style: TextStyle(fontSize: 16),
            ),
          ],
        ),
      ),
    );
  }
}