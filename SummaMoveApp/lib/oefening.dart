// oefening.dart
class Oefening {
  final String name;
  final String description;
  final String image;

  Oefening({required this.name, required this.description, required this.image});

  factory Oefening.fromJson(Map<String, dynamic> json) {
    return Oefening(
      name: json['name'],
      description: json['description'],
      image: json['image'],
    );
  }
}